<li class="nav-item mt-1">
    <a href="{{ route('check_in_out.list') }}"
       class="btn {{ Route::is('check_in_out.list') ? 'btn-info' : 'btn-primary' }}">
        Check IN/OUT List
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('check_in_out.preview') }}"
       class="btn {{ Route::is('check_in_out.preview') ? 'btn-info' : 'btn-primary' }}">
        Edit missing IN/OUT
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
    <a href="{{ route('application-forms.list') }}"
       class="btn {{ Route::is('application-forms.list') ? 'btn-info' : 'btn-primary' }}">
        Application Form Approval
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('overtime-forms.list') }}"
       class="btn {{ Route::is('overtime-forms.list  ') ? 'btn-info' : 'btn-primary' }}">
        Overtime Form Approval
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
    <a href="{{ route('projects.index') }}"
       class="btn {{ Route::is('projects.index') ? 'btn-info' : 'btn-primary' }}">
        Projects List
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('projects.create') }}"
       class="btn {{ Route::is('projects.create') ? 'btn-info' : 'btn-primary' }}">
        Register New Project
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('project-user.index') }}"
       class="btn {{ Route::is('project-user.index') ? 'btn-info' : 'btn-primary' }}">
        Assign Member To Project
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
