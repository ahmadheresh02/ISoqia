<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        $query->when($request->has('sort'), function ($q) use ($request) {
            switch ($request->sort) {
                case 'name':
                    $q->orderBy('full_name', 'asc');
                    break;
                case 'newest':
                    $q->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $q->orderBy('created_at', 'asc');
                    break;
                case 'last_login':
                    $q->orderBy('last_login', 'desc');
                    break;
                default:
                    $q->orderBy('created_at', 'desc');
            }
        }, function ($q) {
            $q->orderBy('created_at', 'desc');
        });

        $users = $query->withCount(['orders', 'carts'])->paginate(15);

        $roles = ['all', 'user', 'admin'];

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        $user->load(['orders.orderItems.product', 'carts.cartItems.product']);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'location' => 'nullable|string|max:255',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'location' => $validated['location'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'location' => 'nullable|string|max:255',
            'role' => 'required|in:user,admin',
        ]);

        $data = [
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'location' => $validated['location'],
            'role' => $validated['role'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::user()->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
