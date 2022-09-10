<template>
    <ul class="nav justify-content-end m-5">
        <li class="nav-item m-2">
            <router-link :to="{name: 'clients.create'}" class="btn btn-info">Novo Cliente</router-link>
        </li>
    </ul>

    <div class="card m-5">
        <div class="card-header">
            Clientes
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">RG</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <template v-for="client in clients" :key="client.id">
                    <tr>
                        <th scope="row">{{ client.id }}</th>
                        <td>{{ client.name }}</td>
                        <td>{{ client.cpf }}</td>
                        <td>{{ client.rg }}</td>
                        <td>{{ client.email }}</td>
                        <td>{{ client.telephone }}</td>
                        <td class="justify-content-end">
                            <button @click="destroyClient(client.id)" class="btn btn-danger me-2 ">Deletar</button>
                            <router-link :to="{ name: 'clients.edit', params: { id: client.id  }}"
                                         class="btn btn-primary">Editar
                            </router-link>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import useClients from "../../composables/clients";
import {onMounted} from "vue";

export default {
    setup() {
        const {clients, getClients, deleteClient} = useClients()

        onMounted(getClients)

        const destroyClient = async (id) => {
            if (!window.confirm("Deseja Realmente deletar?")) {
                return
            }
            await deleteClient(id)
            await getClients()
        }

        return {
            clients,
            destroyClient
        }
    }
}

</script>
