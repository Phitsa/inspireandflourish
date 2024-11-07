<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/home');
})->name('home');

Route::get('/meetings', function () {
    return view('pages/meetings');
})->name('meetings.index');

Route::post('/savemember', [MemberController::class, 'store'])->name('member.store'); 

Route::get('/members', [MemberController::class, 'index'])->name('pages.members'); 

Route::put('/member/update', [MemberController::class, 'update'])->name('pages.updateMember');

Route::delete('/member/delete', [MemberController::class, 'delete'])->name('pages.deleteMember');