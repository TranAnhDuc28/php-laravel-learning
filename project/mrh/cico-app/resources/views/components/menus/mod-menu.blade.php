<li class="nav-item mt-1">
    <a href="{{ route('check_in_out.index') }}"
       class="btn {{ Route::is('check_in_out.index') ? 'btn-info' : 'btn-primary' }}">
        View My Check In/Out
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('check_in_out.list') }}"
       class="btn {{ Route::is('check_in_out.list') ? 'btn-info' : 'btn-primary' }}">
        Check IN/OUT List
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('leave_days.list') }}"
       class="btn {{ Route::is('leave_days.list') ? 'btn-info' : 'btn-primary' }}">
        Day-Off Management
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('days-off.list') }}"
       class="btn {{ Route::is('days-off.list') ? 'btn-info' : 'btn-primary' }}">
        BIP VN Calendar List
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('days-off.create') }}"
       class="btn {{ Route::is('days-off.create') ? 'btn-info' : 'btn-primary' }}">
        BIP VN Calendar Create
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('application-forms.index') }}"
       class="btn {{ Route::is('application-forms.index') ? 'btn-info' : 'btn-primary' }}">
        View My Application Form
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('application-forms.list') }}"
       class="btn {{ Route::is('application-forms.list') ? 'btn-info' : 'btn-primary' }}">
        View Application Form
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('application-forms.create') }}"
       class="btn {{ Route::is('application-forms.create') ? 'btn-info' : 'btn-primary' }}">
        Register Application Form
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('overtime-forms.list') }}"
       class="btn {{ Route::is('overtime-forms.list') ? 'btn-info' : 'btn-primary' }}">
        View Overtime Form
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('teams.index') }}"
       class="btn {{ Route::is('teams.index') ? 'btn-info' : 'btn-primary' }}">
        Team List
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('teams.create') }}"
       class="btn {{ Route::is('teams.create') ? 'btn-info' : 'btn-primary' }}">
        Register New Team
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('team-user.index') }}"
       class="btn {{ Route::is('team-user.index') ? 'btn-info' : 'btn-primary' }}">
        Assign Member To Team
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('user.index') }}"
       class="btn {{ Route::is('user.index') ? 'btn-info' : 'btn-primary' }}">
        User Info Management
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('register') }}"
       class="btn {{ Route::is('register') ? 'btn-info' : 'btn-primary' }}">
        Register New User
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('skill-category.index') }}" class="btn {{ Route::is('skill-category.index') ? 'btn-info' : 'btn-primary' }}">
        Skill-Category
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('skill-item.index') }}" class="btn {{ Route::is('skill-item.index') ? 'btn-info' : 'btn-primary' }}">
        Skill-Item
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('skill-user.list') }}" class="btn {{ Route::is('skill-user.list') ? 'btn-info' : 'btn-primary' }}">
        Skill-User List
    </a>
</li>
