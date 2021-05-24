<template>
    <div class="col-2nd">
        <div class="header">
            <div class="first-group">
                <span>Wallet</span>
                <p>Here you can cash in money to pay your employers</p>
            </div>
            <div class="second-group">
                <a href="">return</a>
            </div>
        </div>
        <div class="sub-header">
            <!-- <button class="btn-post" @click="changeTab(0)">Balance</button> -->
            <button class="btn-post" @click="changeTab(0)">Transaction</button>
            <button class="btn-post" @click="changeTab(1)">Payment Methods</button>
        </div>
        <div class="body">
            <div v-if="tab == 0" class="table-holder">
                <div class="trans-box">
                    <div class="details">
                        <span>Laravel Vue Js web Developer</span><br>
                        <p>Rimuru Tempest</p>
                    </div>
                    <div class="amt">
                        $ 500
                    </div>
                </div>
                <div class="trans-box">
                    <div class="details">
                        <span>Laravel Vue Js web Developer</span><br>
                        <p>Rimuru Tempest</p>
                    </div>
                    <div class="amt">
                        $ 500
                    </div>
                </div>
                <div class="trans-box">
                    <div class="details">
                        <span>Laravel Vue Js web Developer</span><br>
                        <p>Rimuru Tempest</p>
                    </div>
                    <div class="amt">
                        $ 500
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            tab: 0
        }
    },
    methods:{
        changeTab(num){
            this.tab = num;
        }
    }
}
</script>
<style scoped>
    .table-holder{
        padding: 30px;
        background-color: var(--white);
        width: 60%;
        border-radius: 15px;
    }

    .table-holder .trans-box{
        display: flex;
        align-items: center;
        padding: 20px 20px 5px;
    }

    .table-holder .trans-box .details{
        margin-right: auto;
    }

    .table-holder .trans-box .amt{
        font-size: 1.1rem;
        font-weight: 900;
        color:var(--acc1);
    }

    .table-holder .trans-box .details span{
        font-size: 16px;
        font-weight: 700;
        color: var(--accent);
    }

    .table-holder table{
        width: 100%;
    }

    .table-holder table thead th{
        font-weight: 900;
        font-size: 1rem;
        color: var(--accent);
    }

    .table-holder table thead {
        border-bottom: 1px solid var(--accent);
    }

    .table-holder table tbody tr td{
        padding: 1rem 0rem;
        font-size: 1rem;
        color: var(--darkgrey);
    }
</style>