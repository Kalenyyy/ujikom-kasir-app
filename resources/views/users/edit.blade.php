@extends('layouts.template')

@section('content')
    <div class="p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit User</h2>

            <form action="" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="name">Username</label>
                    <input type="text" name="name" id="name" value=""
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="email">Email</label>
                    <input type="email" name="email" id="email" value=""
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="password">Password <small>(Kosongkan jika tidak ingin
                            mengubah)</small></label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="role">Role</label>
                    <select name="role" id="role"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Admin" >Admin</option>
                        <option value="Kasir" >Kasir</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('users.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Batal</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
