<li class="nav-item mt-1">
    <a href="{{ route('check_in_out.index') }}"
       class="btn {{ Route::is('check_in_out.index') ? 'btn-info' : 'btn-primary' }}">
        View Check In/Out History
    </a>
</li>
<li class="nav-item mt-1">
    <a href="{{ route('application-forms.index') }}"
       class="btn {{ Route::is('application-forms.index') ? 'btn-info' : 'btn-primary' }}">
        View Application Form History
    </a>
</li>
@if(auth()->user()->isLeader())
    <li class="nav-item mt-1 ms-4">
        <a href="{{ route('application-forms.list') }}"
           class="btn {{ Route::is('application-forms.list') ? 'btn-info' : 'btn-primary' }}">
            Application Form Approval
        </a>
    </li>
@endif
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('application-forms.create') }}"
       class="btn {{ Route::is('application-forms.create') ? 'btn-info' : 'btn-primary' }}">
        Register Application Form
    </a>
</li>
@if(auth()->user()->isManager())
<li class="nav-item mt-1">
    <a href="{{ route('overtime-forms.list') }}"
       class="btn {{ Route::is('overtime-forms.list') ? 'btn-info' : 'btn-primary' }}">
        Overtime Form Approval
    </a>
</li>
@else
<li class="nav-item mt-1">
    <a href="{{ route('overtime-forms.index') }}"
       class="btn {{ Route::is('overtime-forms.index') ? 'btn-info' : 'btn-primary' }}">
        Overtime Form List
    </a>
</li>
<li class="nav-item mt-1 ms-4">
    <a href="{{ route('overtime-forms.create') }}"
       class="btn {{ Route::is('overtime-forms.create') ? 'btn-info' : 'btn-primary' }}">
        Register OverTime Form
    </a>
</li>
@endif
<li class="nav-item mt-1">
    <a href="{{ route('skill-user.show') }}" class="btn {{ Route::is('skill-user.show') ? 'btn-info' : 'btn-primary' }}">
        Skill
    </a>
</li>
