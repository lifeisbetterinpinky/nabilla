<script setup>
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

// State Reactive untuk Data dan Form
const layanans = ref([])
const pending = ref(true)
const errorMsg = ref(null)

const isEditing = ref(false)
const editId = ref(null)

const form = ref({
  nama_layanan: '',
  kode_layanan: '',
  deskripsi: '',
  persyaratan: '',
  status: 'aktif'
})

// Fungsi Mengambil Data (READ)
const fetchLayanans = async () => {
  pending.value = true
  errorMsg.value = null
  try {
    const data = await $fetch(`${apiBase}/layanans`)
    layanans.value = data
  } catch (err) {
    errorMsg.value = 'Gagal memuat data dari server backend Laravel.'
  } finally {
    pending.value = false
  }
}

onMounted(() => {
  fetchLayanans()
})

// Reset Form
const resetForm = () => {
  form.value = { nama_layanan: '', kode_layanan: '', deskripsi: '', persyaratan: '', status: 'aktif' }
  isEditing.value = false
  editId.value = null
}

// Fungsi Simpan (CREATE & UPDATE)
const handleSubmit = async () => {
  try {
    if (isEditing.value) {
      await $fetch(`${apiBase}/layanans/${editId.value}`, {
        method: 'PUT',
        body: form.value
      })
      alert('Data layanan berhasil diperbarui!')
    } else {
      await $fetch(`${apiBase}/layanans`, {
        method: 'POST',
        body: form.value
      })
      alert('Layanan baru berhasil ditambahkan!')
    }
    resetForm()
    fetchLayanans()
  } catch (err) {
    alert('Terjadi kesalahan: ' + (err.data?.message || err.message))
  }
}

// Fungsi Edit (Trigger)
const handleEdit = (item) => {
  isEditing.value = true
  editId.value = item.id
  form.value = { ...item }
}

// Fungsi Hapus (DELETE)
const handleDelete = async (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus layanan ini?')) {
    try {
      await $fetch(`${apiBase}/layanans/${id}`, {
        method: 'DELETE'
      })
      alert('Data berhasil dihapus!')
      fetchLayanans()
    } catch (err) {
      alert('Gagal menghapus data!')
    }
  }
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 p-6 font-sans">
    <div class="max-w-5xl mx-auto space-y-8">
      
      <!-- Header -->
      <header class="bg-indigo-600 text-white p-6 rounded-2xl shadow-md flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold">Portal Layanan Mahasiswa</h1>
          <p class="text-indigo-100 text-sm">Manajemen CRUD Laravel & Nuxt 3</p>
        </div>
      </header>

      <!-- Form Card (Create / Update) -->
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold mb-4 text-indigo-900">
          {{ isEditing ? 'Edit Data Layanan' : 'Tambah Layanan Baru' }}
        </h3>
        <form @submit.prevent="handleSubmit" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nama Layanan</label>
              <input 
                v-model="form.nama_layanan" 
                type="text" 
                required 
                placeholder="Contoh: Surat Aktif Kuliah" 
                class="mt-1 w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Kode Layanan</label>
              <input 
                v-model="form.kode_layanan" 
                type="text" 
                required 
                placeholder="Contoh: SAK-001" 
                class="mt-1 w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
              />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea 
              v-model="form.deskripsi" 
              required 
              rows="2" 
              class="mt-1 w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
            ></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Persyaratan</label>
            <textarea 
              v-model="form.persyaratan" 
              required 
              rows="2" 
              class="mt-1 w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
            ></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select v-model="form.status" class="mt-1 w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>

          <div class="flex space-x-3 pt-2">
            <button 
              type="submit" 
              class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 font-medium shadow-sm transition"
            >
              {{ isEditing ? 'Simpan Perubahan' : 'Tambah Layanan' }}
            </button>
            <button 
              v-if="isEditing" 
              type="button" 
              @click="resetForm" 
              class="bg-gray-300 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-400 font-medium transition"
            >
              Batal
            </button>
          </div>
        </form>
      </div>

      <!-- Table Card (Read & Delete) -->
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Daftar Layanan Tersedia</h3>

        <!-- Status Loading -->
        <div v-if="pending" class="text-center py-8 text-gray-500">
          Memuat data dari server...
        </div>

        <!-- Status Error -->
        <div v-else-if="errorMsg" class="bg-red-50 text-red-600 p-4 rounded-lg">
          {{ errorMsg }}
        </div>

        <!-- Status Kosong -->
        <div v-else-if="layanans.length === 0" class="text-center py-8 text-gray-500">
          Belum ada data layanan. Silakan tambah melalui form di atas.
        </div>

        <!-- Tabel Data -->
        <div v-else class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-100 border-b text-xs uppercase text-gray-600 tracking-wider">
                <th class="p-3">Kode</th>
                <th class="p-3">Nama Layanan</th>
                <th class="p-3">Deskripsi</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
              <tr v-for="item in layanans" :key="item.id" class="hover:bg-gray-50">
                <td class="p-3 font-mono font-medium text-indigo-600">{{ item.kode_layanan }}</td>
                <td class="p-3 font-semibold text-gray-800">{{ item.nama_layanan }}</td>
                <td class="p-3 text-gray-600 max-w-xs truncate">{{ item.deskripsi }}</td>
                <td class="p-3">
                  <span 
                    :class="item.status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'"
                    class="px-2.5 py-1 rounded-full text-xs font-semibold capitalize"
                  >
                    {{ item.status }}
                  </span>
                </td>
                <td class="p-3 text-center space-x-2">
                  <button 
                    @click="handleEdit(item)" 
                    class="bg-amber-500 text-white px-3 py-1.5 rounded-md text-xs font-medium hover:bg-amber-600 transition"
                  >
                    Edit
                  </button>
                  <button 
                    @click="handleDelete(item.id)" 
                    class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs font-medium hover:bg-red-700 transition"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</template>