<div class="form-group mb-3">
    <label>Name</label>
    <input type="text" name="name"
           value="{{ old('name', $user->name ?? '') }}"
           class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Email</label>
    <input type="email" name="email"
           value="{{ old('email', $user->email ?? '') }}"
           class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
    <small class="text-muted">
        Leave blank to keep existing password (edit mode)
    </small>
</div>

<div class="mb-3">

    <label>
        Role
    </label>

    <select
        name="role_id"
        class="form-control"
    >

        <option value="">
            Select Role
        </option>

        @foreach($roles as $role)

            <option
                value="{{ $role->id }}"
                @selected(
                    old(
                        'role_id',
                        optional(
                            $user ?? null
                        )->roles?->first()?->id
                    ) == $role->id
                )
            >
                {{ $role->name }}
            </option>

        @endforeach

    </select>

</div>