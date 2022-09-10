import {ref} from 'vue'
import axios from "axios";
import {useRouter} from "vue-router"

export default function useClients() {
    const clients = ref([])
    const client = ref([])
    const router = useRouter()
    const errors = ref('')
    const photo = ref('')

    const getClients = async () => {
        let response = await axios.get('api/clients')
        clients.value = response.data.data
    }

    const getClient = async (id) => {
        let response = await axios.get('../../api/clients/' + id)
        client.value = response.data.data
    }

    const deleteClient = async (id) => {
        await axios.delete('api/clients/' + id)
    }

    const storeClient = async (data) => {
        errors.value = ''
        try {
            await axios.post('../api/clients', data)
            await router.push({name: 'clients.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + '<br>'
                }
            }
        }
    }

    const updateClient = async (id) => {
        errors.value = ''
        try {
            await axios.put('../../api/clients/' + id, client.value)
            await router.push({name: 'clients.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + '<br>'
                }
            }
        }
    }

    const uploadClient = async (data) => {
        errors.value = ''
        try {
            photo.value = await axios.post('../../api/clients-upload', data, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            })
            photo.value = photo.value.data.file
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + '<br>'
                }
            }
        }
    }

    return {
        clients,
        client,
        photo,
        errors,
        getClients,
        getClient,
        storeClient,
        updateClient,
        deleteClient,
        uploadClient
    }
}
