<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Berita / Block</h1>

      <!-- Form Input Berita -->
      <form @submit.prevent="saveBerita" class="mb-8 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Judul Berita</label>
            <input v-model="form.judul" type="text" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <input v-model="form.kategori" type="text" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Siapa Yang Buat</label>
            <input v-model="form.siapa_yang_buat" type="text" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input v-model="form.tanggal" type="date" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Gambar (URL)</label>
          <input v-model="form.gambar" type="text" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="https://..." />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Isian Berita</label>
          <textarea v-model="form.isian" class="mt-1 block w-full border border-gray-300 rounded-md p-2 h-28" required></textarea>
        </div>
        <div class="flex gap-2">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            {{ isEdit ? 'Update Berita' : 'Tambah Berita' }}
          </button>
          <button v-if="isEdit" @click="resetForm" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md">
            Batal
          </button>
        </div>
      </form>

      <!-- Tabel Data Berita -->
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pembuat</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="item in beritas" :key="item.id">
              <td class="px-4 py-4 whitespace-nowrap font-medium text-gray-900">{{ item.judul }}</td>
              <td class="px-4 py-4 whitespace-nowrap text-gray-500">{{ item.kategori }}</td>
              <td class="px-4 py-4 whitespace-nowrap text-gray-500">{{ item.siapa_yang_buat }}</td>
              <td class="px-4 py-4 whitespace-nowrap text-gray-500">{{ item.tanggal }}</td>
              <td class="px-4 py-4 whitespace-nowrap space-x-2">
                <button @click="editBerita(item)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                <button @click="deleteBerita(item.id)" class="text-red-600 hover:text-red-900">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const beritas = ref([])
const isEdit = ref(false)
const editId = ref(null)

const form = ref({
  judul: '',
  kategori: '',
  siapa_yang_buat: '',
  tanggal: '',
  gambar: '',
  isian: ''
})

const fetchBeritas = async () => {
  try {
    const res = await $fetch('http://127.0.0.1:8000/api/beritas')
    beritas.value = res.data
  } catch (err) {
    console.error('Error fetching data:', err)
  }
}

const saveBerita = async () => {
  try {
    if (isEdit.value) {
      await $fetch(`http://127.0.0.1:8000/api/beritas/${editId.value}`, {
        method: 'PUT',
        body: form.value
      })
    } else {
      await $fetch('http://127.0.0.1:8000/api/beritas', {
        method: 'POST',
        body: form.value
      })
    }
    resetForm()
    fetchBeritas()
  } catch (err) {
    console.error('Error saving data:', err)
  }
}

const editBerita = (item) => {
  isEdit.value = true
  editId.value = item.id
  form.value = { ...item }
}

const deleteBerita = async (id) => {
  if (confirm('Yakin ingin menghapus berita ini?')) {
    try {
      await $fetch(`http://127.0.0.1:8000/api/beritas/${id}`, {
        method: 'DELETE'
      })
      fetchBeritas()
    } catch (err) {
      console.error('Error deleting data:', err)
    }
  }
}

const resetForm = () => {
  isEdit.value = false
  editId.value = null
  form.value = {
    judul: '',
    kategori: '',
    siapa_yang_buat: '',
    tanggal: '',
    gambar: '',
    isian: ''
  }
}

onMounted(() => {
  fetchBeritas()
})
</script>