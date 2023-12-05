<!-- Include Alpine.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<!-- Your website content goes here -->

<!-- Footer -->
<footer x-data="{ isOpen: false }" class="bg-gray-800 text-white p-4">
    <div class="container mx-auto">
        <p>&copy; 2023 Your Website. All rights reserved.</p>
        
        <!-- Button to toggle footer content -->
        <button @click="isOpen = !isOpen" class="mt-2 text-blue-500 focus:outline-none">
            {{ isOpen ? 'Hide Details' : 'Show Details' }}
        </button>
        
        <!-- Additional footer content (toggleable) -->
        <div x-show="isOpen" class="mt-2">
            <p>Contact us: contact@example.com</p>
            <p>Address: 123 Main St, Cityville</p>
        </div>
    </div>
</footer>
