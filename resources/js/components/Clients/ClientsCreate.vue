<template>
    <ul class="nav justify-content-end m-5">
        <li class="nav-item m-2">
            <router-link :to="{name: 'clients.index'}" class="btn btn-dark">Voltar para Lista</router-link>
        </li>
    </ul>

    <form @submit.prevent="saveClient">
        <div class="card m-5">
            <div class="card-header">
                Criar Clientes
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
                               v-model="form.name">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="CPF" aria-label="CPF" name="cpf" id="cpf"
                               v-model="form.cpf" v-mask="'###.###.###-##'">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="RG" aria-label="RG" name="rg" id="rg"
                               v-model="form.rg">
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="mail" class="form-control" placeholder="Email" aria-label="Email" name="email"
                               id="email"
                               v-model="form.email">
                    </div>

                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Telefone" aria-label="Telefone"
                               name="telephone"
                               v-mask="['(##) ####-####', '(##) #####-####']"
                               id="telephone" v-model="form.telephone">
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Cep" aria-label="Cep" name="cep" id="cep"
                               v-mask="'#####-###'"
                               v-model="form.cep">
                    </div>
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Endereço" aria-label="Endereço"
                               name="address"
                               id="address" v-model="form.address">
                    </div>
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Numero" aria-label="Numero"
                               name="address_number"
                               id="address_number" v-model="form.address_number">
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Estado" aria-label="Estado" name="state"
                               id="state"
                               v-model="form.state">
                    </div>
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Cidade" aria-label="Cidade" name="city"
                               id="city"
                               v-model="form.city">
                    </div>
                    <div class="input-group mb-3 col">
                        <input type="text" class="form-control" placeholder="Bairro" aria-label="Bairro"
                               name="neighborhood"
                               id="neighborhood" v-model="form.neighborhood">
                    </div>
                </div>

                <div class="input-group mb-3 ">
                    <input type="hidden" class="form-control" v-model="form.avatar">

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file"
                               @change="uploadImage">
                        <label class="custom-file-label" for="file">Escolha o Ficheiro</label>
                    </div>
                </div>

                <div class="w-100 p-3 align-self-end">
                    <button class="btn btn-primary">Criar Cliente</button>
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
    directives: {mask},

    setup() {
        const form = reactive({
            'name': '',
            'cpf': '',
            'rg': '',
            'email': '',
            'telephone': '',
            'cep': '',
            'address': '',
            'city': '',
            'neighborhood': '',
            'state': '',
            'address_number': '',
            'avatar': '',
        })

        const {errors, photo, storeClient, uploadClient} = useClients()

        const saveClient = async () => {
            await storeClient({...form});
        }

        const uploadImage = async (e) => {

            await uploadClient({
                'file': e.target.files[0]
            });
            form.avatar = photo
        }

        return {
            form,
            photo,
            errors,
            saveClient,
            uploadImage
        }
    }
}

</script>


