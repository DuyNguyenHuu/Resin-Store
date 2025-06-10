@extends('layouts.home')
@section('content')
    <div style="display:flex;justify-content:center;gap:3em;padding: 5em 0 5em 0">
        <div class="login">
            <h3>Đăng nhập</h3>
            <form>
                <input class="account"placeholder="Email"><br>
                <input class="account"placeholder="Mật khẩu">
                <div style="display:flex; justify-content: space-around;">
                    <div><input type="checkbox">Nhớ mật khẩu</div>
                    <div><a href="">Quên mật khẩu</a></div>
                </div>
                <button type="submit">Đăng nhập</button>
            </form>
        </div>
        <div class="register">
            <h3>Đăng ký</h3>
            <form>
                <div>
                    <label>Họ tên</label><br>
                    <input style=" width:26em"placeholder="Họ tên">
                </div>
                <div style="display:flex;gap:2.5em">
                    <div>
                        <label>Email</label>
                        <input placeholder="Email">
                    </div>
                    <div>
                        <label>Điện thoại</label>
                        <input placeholder="Điện thoại">
                    </div>
                </div>
                <div style="display:flex;gap:2.5em">
                    <div>
                        <label>Mật khẩu</label>
                        <input placeholder="Mật khẩu">
                    </div>
                    <div>
                        <label>Xác nhận mật khẩu</label>
                        <input placeholder="Xác nhận mật khẩu">
                    </div>
                </div>
                <button type="submit">Đăng ký</button>
            </form>
        </div>
    </div>
@endsection