<div x-data="filamentDropdown" class="fi-dropdown fi-user-menu">
    <div x-on:mousedown="if ($event.button === 0) toggle($event)" class="fi-dropdown-trigger">
        <button aria-label="User menu" type="button" class="fi-user-menu-trigger fi-padding-3 text-sm">
            <x-filament::icon-button icon="heroicon-o-globe-europe-africa"
            size="xl" iconSize="xl" color="info" type="button" style="margin:auto 10px;" />
        </button>
    </div>
    <div x-float.placement.bottom-end.flip.teleport.offset="{ offset: 8,  }" x-ref="panel"
        x-transition:enter-start="fi-opacity-0" x-transition:leave-end="fi-opacity-0" class="fi-dropdown-panel "
        style="position: fixed; display: none;">
        <div class="fi-dropdown-list">
            <a href="{{ route('locale', 'ar') }}" class="fi-dropdown-list-item fi-ac-grouped-action">
                <span class="fi-dropdown-list-item-label">العربية </span>
            </a>
        </div>
        <div class="fi-dropdown-list">
            <a href="{{ route('locale', 'en') }}" class="fi-dropdown-list-item fi-ac-grouped-action">
                <span class="fi-dropdown-list-item-label">English </span>
            </a>
        </div>
    </div>
</div>
