<?php

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/home');
})->name('home');

Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');

Route::post('/meetings/save', [MeetingController::class, 'store'])->name('meeting.store');

Route::put('/meetings/update', [MeetingController::class, 'update'])->name('meeting.update');

Route::post('/savemember', [MemberController::class, 'store'])->name('member.store'); 

Route::get('/members', [MemberController::class, 'index'])->name('pages.members'); 

Route::put('/member/update', [MemberController::class, 'update'])->name('pages.updateMember');

Route::delete('/member/delete', [MemberController::class, 'delete'])->name('pages.deleteMember');