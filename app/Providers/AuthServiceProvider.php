use Illuminate\Support\Facades\Gate;

public function boot()
{
    Gate::define('manage-admins', function ($user) {
        return $user->isSuperAdmin();
    });
}