<div
    x-id="['dropdown-button', 'dropdown-menu']"
    data-dropdown
    x-data="{
        open: false,
        focusableItems() {
            return Array.from(this.$refs.menu?.querySelectorAll('[role=menuitem]') || []);
        },
        focusFirstItem() {
            const items = this.focusableItems();
            if (items.length) {
                items[0].focus();
            }
        },
        focusLastItem() {
            const items = this.focusableItems();
            if (items.length) {
                items[items.length - 1].focus();
            }
        },
        focusNextItem() {
            const items = this.focusableItems();
            if (!items.length) {
                return;
            }
            const currentIndex = items.indexOf(document.activeElement);
            const nextIndex = currentIndex === -1 ? 0 : (currentIndex + 1) % items.length;
            items[nextIndex].focus();
        },
        focusPrevItem() {
            const items = this.focusableItems();
            if (!items.length) {
                return;
            }
            const currentIndex = items.indexOf(document.activeElement);
            const prevIndex = currentIndex <= 0 ? items.length - 1 : currentIndex - 1;
            items[prevIndex].focus();
        },
        openMenu() {
            if (this.open) {
                return;
            }
            this.open = true;
        },
        openMenuAndFocusLast() {
            if (this.open) {
                this.$nextTick(() => this.focusLastItem());
                return;
            }
            this.open = true;
            this.$nextTick(() => this.focusLastItem());
        },
        toggleAndFocus() {
            if (this.open) {
                this.closeAndFocus();
                return;
            }
            this.open = true;
        },
        close() {
            this.open = false;
        },
        closeAndFocus() {
            this.open = false;
            this.$nextTick(() => this.$refs.trigger?.focus());
        }
    }"
    @click.outside="close()"
    @keydown.escape.stop.prevent="closeAndFocus()"
    {{ $attributes->merge(['class' => 'relative inline-flex']) }}
>
    {{ $slot }}
</div>
