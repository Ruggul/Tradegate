<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Admin</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="edit_name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" 
                           id="edit_name" 
                           name="name" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="edit_email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" 
                           id="edit_email" 
                           name="email" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           required>
                </div>

                <!-- Password (Optional) -->
                <div class="mb-4">
                    <label for="edit_password" class="block text-gray-700 text-sm font-bold mb-2">New Password (leave blank to keep current)</label>
                    <input type="password" 
                           id="edit_password" 
                           name="password" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Password Confirmation -->
                <div class="mb-4">
                    <label for="edit_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                    <input type="password" 
                           id="edit_password_confirmation" 
                           name="password_confirmation" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="edit_role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                    <select name="role" 
                            id="edit_role" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>

                <!-- Profile Image -->
                <div class="mb-4">
                    <label for="edit_image" class="block text-gray-700 text-sm font-bold mb-2">Profile Image</label>
                    <input type="file" 
                           id="edit_image" 
                           name="image" 
                           accept="image/*"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="edit_is_active" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="is_active" 
                            id="edit_is_active" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('editModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(adminId) {
    fetch(`/admin/${adminId}/edit`)
        .then(response => response.json())
        .then(admin => {
            document.getElementById('edit_name').value = admin.name;
            document.getElementById('edit_email').value = admin.email;
            document.getElementById('edit_role').value = admin.role;
            document.getElementById('edit_is_active').value = admin.is_active ? '1' : '0';
            document.getElementById('editForm').action = `/admin/${adminId}`;
            document.getElementById('editModal').classList.remove('hidden');
        });
}
</script> 