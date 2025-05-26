<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use App\Models\User;

class EditProfile extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.edit-profile';
    protected static ?string $title = 'Edit Profile';

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),
            Forms\Components\TextInput::make('password')
                ->label('New Password')
                ->password()
                ->minLength(8)
                ->confirmed()
                ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                ->nullable(),
            Forms\Components\TextInput::make('password_confirmation')
                ->label('Confirm New Password')
                ->password()
                ->nullable(),
        ];
    }

public function submit()
{
    $data = $this->form->getState();
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $user->name = $data['name'];
    $user->email = $data['email'];
    if ($data['password']) {
        $user->password = $data['password'];
    }
    $user->save();

    Notification::make()
        ->title('Profile updated successfully!')
        ->success()
        ->send();
}
}