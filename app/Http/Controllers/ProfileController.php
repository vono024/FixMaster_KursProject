<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Профіль оновлено!');
    }

    public function changePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Поточний пароль невірний']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Пароль змінено!');
    }

    public function deleteAvatar(Request $request)
    {
        try {
            $user = $request->user();

            \Log::info('Спроба видалити аватар', ['user_id' => $user->id, 'avatar' => $user->avatar]);

            if ($user->avatar) {
                if (\Storage::disk('public')->exists($user->avatar)) {
                    \Storage::disk('public')->delete($user->avatar);
                    \Log::info('Файл видалено', ['path' => $user->avatar]);
                } else {
                    \Log::warning('Файл не знайдено', ['path' => $user->avatar]);
                }

                $user->avatar = null;
                $user->save();

                \Log::info('Аватар видалено з бази');

                return redirect()->route('profile.edit')->with('success', 'Фото профілю видалено');
            }

            return redirect()->route('profile.edit')->with('info', 'Немає фото для видалення');

        } catch (\Exception $e) {
            \Log::error('Помилка видалення аватара', ['error' => $e->getMessage()]);
            return redirect()->route('profile.edit')->with('error', 'Помилка: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.edit', compact('user'));
    }
}
