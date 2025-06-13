<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblnhanvien;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string',
            'MatKhau' => 'required|string',
        ]);

        $nhanVien = tblnhanvien::where('TenDangNhap', $request->TenDangNhap)->first();

        if (!$nhanVien || !Hash::check($request->MatKhau, $nhanVien->MatKhau)) {
            return back()->withErrors(['login' => 'Tên đăng nhập hoặc mật khẩu không chính xác']);
        }

        // Lưu session
        session()->put(['TenDangNhap' => $nhanVien->TenDangNhap]);
        session()->put(['MaNV' => $nhanVien->MaNV]);

        return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
    }
    public function logout()
    {
        session()->flush(); // Xóa toàn bộ session
        return redirect()->route('homepage');
    }
}
