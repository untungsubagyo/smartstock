<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDevice;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_id' => 'required',
            'device_name' => 'nullable|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'User inactive'], 403);
        }

        // Update last login
        $user->last_login_at = now();
        $user->save();

        // Buat token Sanctum baru
        $token = $user->createToken($request->device_id)->plainTextToken;

        // Simpan atau update info perangkat
        UserDevice::updateOrCreate(
            ['device_id' => $request->device_id],
            [
                'user_id' => $user->id,
                'device_name' => $request->device_name ?? 'Unknown',
                'ip_address' => $request->ip(),
                'os' => $request->header('User-Agent'),
                'app_version' => $request->header('App-Version', 'unknown'),
                'last_login_at' => now(),
                'is_active' => true,
            ]
        );
        logUserActivity($user->id, 'LOGIN', 'auth', null, 'User login via API');
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token saat ini (logout dari device ini saja)
        $request->user()->currentAccessToken()->delete();
        logUserActivity($request->user()->id, 'LOGOUT', 'auth', null, 'User logged out');
        return response()->json(['message' => 'Logged out']);
    }

    public function logoutAll(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Semua device sudah logout'
            ], 200);
        }

        $tokenCount = $user->tokens()->count();

        if ($tokenCount === 0) {
            return response()->json([
                'message' => 'Semua device sudah logout'
            ], 200);
        }

        $user->tokens()->delete();

        logUserActivity($user->id, 'LOGOUT_ALL', 'auth', null, 'User logout dari semua perangkat');

        return response()->json([
            'message' => 'Berhasil logout dari semua device (' . $tokenCount . ' token dihapus)'
        ], 200);
    }

}
