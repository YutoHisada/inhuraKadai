<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 3</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    
                    <div class="quesion-header">電卓を作成してください。</div>

                    <div>
                        
                        <tr>
                            <td><input type="text" v-model="output" style="width:97px"></td>
                            <td><button value="C" v-on:click="calc('C')" style="width:30px;height:30px;">C</button></td>
                        </tr>
                        <table>
                            <tr v-for="(row, index) in items" :key=index>
                                <td v-for="(item, index) in row" :key=index>
                                    <button v-on:click="calc(item)" style="width:30px;height:30px;">{{ item }}</button>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

// eval()関数は文字列をプログラムとして評価するため
// セキュリティ面では危険

export default {
    props: {
        //
    },
    data () {
        return {
            output: '0',
            items: [
                ['7', '8', '9', '/'],
                ['4', '5', '6', '*'],
                ['1', '2', '3', '-'],
                ['0', '.', '+', '=']
            ]
        }
    },
    mounted () {
        //
    },
    watch: {
        //
    },
    computed: {
        //
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'home' })
        },
        calc: function(cmd) {
            if(cmd === '=') {
                this.output = eval(this.output)
            }else if(cmd === 'C') {
                this.output = '0'
            }else if(this.output === '0') {
                this.output = cmd
            }else{
                this.output += cmd
            }
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>