<div {{ $attributes }}>
    <x-article-input-text label="Role Name" name="name" :description="$role->name"/>
    <x-role-input-check-box label="Abilities" name="abilities" :items="$abilities" :exitItems="$role->abilities"/>
    <x-article-input-textarea label="Description" name="description" :description="$role->description"/>
</div>
