import './bootstrap';

// Checking if Alpine (supplied with livewire) is running
document.addEventListener('alpine:init', (event) => {
    console.log('Alpine:init');
});
