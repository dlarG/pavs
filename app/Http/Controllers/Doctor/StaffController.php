<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StaffController extends Controller
{
    public function index()
    {
        $staffMembers = User::where('role', 'staff')->paginate(10);
        return view('doctor.staff.index', compact('staffMembers'));
    }

    public function create()
    {
        return view('doctor.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'staff',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('doctor.staff.index')
            ->with('success', 'Staff member created successfully.');
    }

    public function show($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('doctor.staff.show', compact('staff'));
    }

    public function edit($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('doctor.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $staff->update($data);

        return redirect()->route('doctor.staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $staff->delete();

        return redirect()->route('doctor.staff.index')
            ->with('success', 'Staff member deleted successfully.');
    }
}