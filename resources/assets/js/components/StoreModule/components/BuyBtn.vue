<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="490">
            <v-btn class="btn-basket" slot="activator" color="primary" dark><i class="material-icons">add_shopping_cart</i></v-btn>

            <v-card ref="form">
                    <v-card-title class="headline grey lighten-2">Реквизиты покупателя</v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field
                                            class="user-input"
                                            ref="fio"
                                            v-model="fio"
                                            :counter="40"
                                            label="Имя Фамилия"
                                            required
                                            :rules="[() => !!fio || 'Обязательно для заполнения']"
                                            hint="Иванов Иван"
                                            :error-messages="errorMessages"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs6>
                                    <v-text-field
                                            class="user-input"
                                            ref="email"
                                            v-model="email"
                                            label="E-mail"
                                            required
                                            :rules="[
                                                () => !!email || 'Обязательно для заполнения',
                                                () => /.+@.+/.test(email) || 'E-mail должен быть правильный'
                                                ]"
                                            hint="primer@mail.ru"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs6>
                                    <v-text-field
                                            class="user-input"
                                            ref="phone"
                                            v-model="phone"
                                            label="Телефон"
                                            required
                                            :rules="[
                                                        () => !!phone || 'Обязательно для заполнения',
                                                    ]"
                                            hint="+7(555)555-55-55"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field
                                            class="user-input"
                                            ref="address"
                                            v-model="address"
                                            label="Адрес доставки"
                                            required
                                            :counter="100"
                                            :rules="[
                                                      () => !!address || 'Обязательно для заполнения',
                                                      () => !!address && address.length <= 100 || 'не более 100 символов'
                                                    ]"
                                            hint="Москва, ул. Примерная, д.12, кв.16"
                                    ></v-text-field>
                                </v-flex>

                                <v-divider class="my-2 "></v-divider>
                                <v-subheader>Для регистрации в личном кабинете:</v-subheader>
                                <v-flex xs6>
                                    <v-text-field
                                            class="user-input"
                                            v-model="nick_name"
                                            :counter="20"
                                            label="Логин"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs6>
                                    <v-text-field
                                            class="user-input"
                                            :append-icon="showPsw ? 'visibility_off' : 'visibility'"
                                            :type="showPsw ? 'text' : 'password'"
                                            v-model="psw"
                                            :counter="40"
                                            label="Пароль"
                                            @click:append="showPsw = !showPsw"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-textarea
                                            class="user-input"
                                            v-model="comment"
                                            color="teal"
                                    >
                                        <div slot="label">
                                            Комментарий к заказу <small>(если есть)</small>
                                        </div>
                                    </v-textarea>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                <v-divider class="my-1 "></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click.native="dialog = false">Отмена</v-btn>
                    <v-btn color="green darken-1" flat @click.native="saveToInvoice">Сохранить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
  export default {
    name: "BuyBtn",
    data (){
      return {
        dialog: false,
        model: {},

        fio: null,
        address: null,
        email: null,
        phone: null,
        nick_name: null,
        psw: null,
        comment: null,
        showPsw: false,
        errorMessages: '',
        formHasErrors: false,

      }
    },
    computed: {
      form () {
        return {
          fio: this.fio,
          email: this.email,
          phone: this.phone,
          address: this.address
        }
      }
    },

    methods:{
      saveToInvoice(){
        this.formHasErrors = false;
        let app = this;

        Object.keys(app.form).forEach(f => {
          if (!app.form[f]) {
            app.formHasErrors = true;
          }
          app.$refs[f].validate(true)
        });

        if (this.formHasErrors){
            console.log('Ошибка валидации');
        }else{
          let clientId = this.$store.state.clients.id ? this.$store.state.clients.id : null
            let newClient = {
              id: clientId,
              fio: this.fio,
              email: this.email,
              phone: this.phone,
              address: this.address,
              nick_name: this.nick_name,
              psw: this.psw,
              comment:null
            };
            this.$store.dispatch("addClient",  newClient);
            console.log('client saved');
            this.dialog = false;
        }

      }
    },
    watch: {
      fio () {
        this.errorMessages = ''
      }
    },
  }
</script>

<style scoped>
    .user-input, input[type=text]:not(.browser-default):focus:not([readonly]){
        border: none !important;
        border-bottom: 0 !important;
        margin: 0;
    }
    .user-input, input{
        border: none !important;
        border-bottom: 0 !important;
        margin: 0;
    }

</style>