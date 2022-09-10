<template>
    <ul class="nav justify-content-end m-5">
        <li class="nav-item m-2">
            <router-link :to="{name: 'clients.create'}" class="btn btn-info">Novo Cliente</router-link>
        </li>
        <li class="nav-item m-2">
            <router-link :to="{name: 'clients.index'}" class="btn btn-dark">Voltar para Lista</router-link>
        </li>
    </ul>

    <form @submit.prevent="saveClient">
        <div class="card m-5">
            <div class="card-header">
                Editar Cliente - {{ client.name }}
            </div>
            <div class="card-body">
                <div v-if="errors !==''" class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    {{ errors }}
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Nome" aria-label="Nome" name="name"
                               id="name"
                               v-model="client.name">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="CPF" aria-label="CPF" name="cpf" id="cpf"
                               v-model="client.cpf" v-mask="'###.###.###-##'">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="RG" aria-label="RG" name="rg" id="rg"
                               v-model="client.rg">
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="mail" class="form-control" placeholder="Email" aria-label="Email" name="email"
                               id="email"
                               v-model="client.email">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Telefone" aria-label="Telefone"
                               name="telephone"
                               v-mask="['(##) ####-####', '(##) #####-####']"
                               id="telephone" v-model="client.telephone">
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Cep" aria-label="Cep" name="cep" id="cep"
                               v-model="client.cep" v-mask="'#####-###'">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Endereço" aria-label="Endereço"
                               name="address"
                               id="address" v-model="client.address">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Numero" aria-label="Numero"
                               name="address_number"
                               id="address_number" v-model="client.address_number">
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Estado" aria-label="Estado" name="state"
                               id="state"
                               v-model="client.state">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Cidade" aria-label="Cidade" name="city"
                               id="city"
                               v-model="client.city">
                    </div>
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Bairro" aria-label="Bairro"
                               name="neighborhood"
                               id="neighborhood" v-model="client.neighborhood">
                    </div>
                </div>

                <div class="row">

                    <img :src="'../../../photos/'+client.avatar" class="rounded float-left img-fluid" v-if="client.avatar" style="max-width: 100px" >

                    <div class="input-group mb-3 col">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file"
                                   @change="uploadImage">
                            <label class="custom-file-label" for="file">Escolha o Ficheiro</label>
                        </div>
                    </div>
                    <div class="w-100 p-3 text-right">
                        <button class="btn btn-primary">Salvar Cliente</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</template>

<script>
import {mask} from 'vue-the-mask'
import {onMounted, reactive} from "vue";
import useClients from "../../composables/clients";

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    directives: {mask},

    setup(props) {

        const {client, errors, getClient, updateClient, uploadClient, photo} = useClients()

        onMounted(getClient(props.id))


        const saveClient = async () => {
            await updateClient(props.id);
        }

        const uploadImage = async (e) => {
            await uploadClient({
                'id': props.id,
                'file': e.target.files[0]
            });
            onMounted(getClient(props.id))
        }

        return {
            client,
            errors,
            photo,
            saveClient,
            uploadImage
        }
    }
}

</script>


