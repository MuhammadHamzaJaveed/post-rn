<?php

namespace App\Http\Livewire\Components\CreateEditUserForm;

use App\Services\UserServices\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Rule;

class CreateEditUserForm extends ModalComponent
{
    protected $userServices;

    public $user;

    public $role_name;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'role_name' => 'required',
        ];
    }

    /**
     * Summary of boot
     * @param  UserServices  $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param int|null $userId
     * @return string|void
     */
    public function mount(int $userId = null)
    {
        if ($userId) {

            $this->user = $this->userServices->findOneUserById($userId)[0];
            $this->role_name        = $this->user->roles[0]->name;
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function submit()
    {   
        $this->validate();
        $message = "The user role has been updated successfully";
        $this->user->syncRoles([$this->role_name]);

        Session::flash(
            'primary',
            $message
        );

        return redirect(route('user-details'));
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.components.create-edit-user-form.create-edit-user-form');
    }
}
