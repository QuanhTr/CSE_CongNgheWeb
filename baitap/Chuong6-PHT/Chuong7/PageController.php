<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // TODO 8: Thêm phương thức này
    public function showHomepage()
    {
        $viewTitle = 'PHT Chương 7 - Blade Template'; 
        $pageTitle = 'Chào mừng bạn đến với Blade!'; 
        $pageDescription = 'Đây là trang chủ được render bằng Blade Template Engine.'; 
        $tasks = [ 
            'Cài đặt Laravel', 
            'Hiểu về Routing & Controller', 
            'Tạo Layout với Blade', 
            'Truyền dữ liệu cho View' 
        ]; 
 
        // TODO 8: Trả về một View 
        // Gợi ý: Dùng hàm view('ten_view', $data_array) 
        // 'homepage' tương đương 'homepage.blade.php' 
                 return view('home', [ 
            'title' => $viewTitle, 
            'page_title' => $pageTitle, 
            'page_description' => $pageDescription, 
            'tasks' => $tasks 
        ]); 
 
        // TODO 9: (Cách khác) Dùng hàm compact() cho gọn 
         return view('homepage', compact('viewTitle', 'pageTitle', 'pageDescription', 'tasks')); 
    }
}
