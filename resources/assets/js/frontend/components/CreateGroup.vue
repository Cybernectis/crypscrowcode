<template>
    <div>
        <input type="hidden" name="name" id="chatname" v-model="name"  />
        <input type="hidden" name="trade_id" id="trade_id" v-model="trade_id"  />
        <input type="hidden" name="offer_type_id" id="offer_type_id" v-model="offer_type_id"  />
        <input type="hidden" name="local_coins_id" id="local_coins_id" v-model="local_coins_id"  />
        <div class="form-group">
            <input type="number" class="form-control" name="amount" id="amount" placeholder="" v-model="amount" min="" max=""  required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="coin_quantity" name="coin_quantity" placeholder="Cryptocoin" v-model="coin_quantity" required readonly>
        </div>
        <div class="form-group">
            <button type="submit" @click.prevent="createGroup" class="btn create-btn" style="width: 100%">OPEN TRADE</button>
        </div>
        <div v-for="error in errors" v-if="errors.length > 0" class="alert alert-danger">
            {{error}}
        </div>
    </div>         
</template>

<script>
    export default {
        props: ['initialUsers'],
 
        data() {
            return {
                errors:[],
                users: [],
                amount:"",
                name:"",
                trade_id:"",
                offer_type_id:"",
                local_coins_id:"",
                coin_quantity:'',
                quantity:''
            }
        },

        watch: {
          'coin_quantity':function (val) {
           console.log("val" + val);
           this.quantity = val;
          }
        },
        methods: {
            
            createGroup() {
                var url = host+'/groups';
                console.log(this.coin_quantity);
                axios.post(url, {name: name, users: this.initialUsers.id, amount:this.amount, coin_quantity:coinQuantity, trade_id:trade_id, offer_type_id:offer_type_id,local_coins_id:local_coins_id })
                .then((response) => {
                    this.name = '';
                    this.users = [];
                    Bus.$emit('groupCreated', response.data);
                    location.href = host+"/trade/"+response.data.uuid;
                });
            }
        }
    }
</script>
