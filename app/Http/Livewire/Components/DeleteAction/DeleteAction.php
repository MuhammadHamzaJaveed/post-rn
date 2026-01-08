<?php

namespace App\Http\Livewire\Components\DeleteAction;

use App\Services\UserServices\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use LivewireUI\Modal\ModalComponent;

class DeleteAction extends ModalComponent
{
    protected $userServices;

    public $deleteItemId;

    /**
     * Summary of boot
     * @param UserServices $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param  int  $deleteItemId
     * @return void
     */
    public function mount(int $deleteItemId)
    {
        $this->deleteItemId = $deleteItemId;
    }

    /**
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function deleteItem()
    {
        $this->userServices->deleteUser($this->deleteItemId);

        Session::flash(
            'primary',
            "The user has been deleted successfully"
        );

        return redirect(route('dashboard'));
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.components.delete-action.delete-action');
    }
}
