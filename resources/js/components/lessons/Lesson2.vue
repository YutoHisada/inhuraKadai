<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 2</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="quesion-header">１．入力値の合計を表示してください。</div>
                        <input type="number" v-model.number="left">
                        +
                        <input type="number" v-model.number="right">
                        =
                        {{ total }}
                    </div>
                    <div class="mb-5">
                        <div class="quesion-header">２．年齢を表示してください。</div>
                        <label for="birthday">お誕生日は？</label>
                        <input type="date" id="birthday" v-model="birthday" v-on:change="Change">
                        
                        <p v-if="age >= 0 && age <= 1000">{{ age }} 歳ですね！</p>
                        <p v-else>お誕生日を入力してください。</p>
                    </div>
                    <div class="mb-5">
                        <div class="quesion-header">３．プラスボタン、マイナスボタンで数値を変更できるようにしてください。</div>
                        <label>カウンター</label>
                        <button @click="Plus" style="width:2rem;">+</button>
                        <button @click="Minus" style="width:2rem;">-</button>
                        {{count}}
                        <!-- <pre>
                            {{ $data }}
                            <br>
                            {{ birthday | moment }}
                        </pre> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// ２の年齢表示で使用
import moment from 'moment';
// import func from 'vue-editor-bridge';

export default {
    props: {
        //
    },
    data () {
        return {
            left: 0,
            right: 0,
            birthday: null,
            count: 0,
            time: null,
            birtYear: null,
        }
    },
    //マウントされたら（初期化処理）
    mounted () {
        this.time = moment(Date()).format('YYYYMMDD')
        //
    },
    watch: {
        //
    },
    computed: {
        total() {
            return this.right+this.left
        },
        age() {
            return Math.floor((this.time - this.birtYear) / 10000)
        }
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'home' })
        },
        Plus() {
            this.count++
        },
        Minus() {
            this.count--;
        },
        //誕生日入力後処理
        Change() {
            this.birtYear = moment(this.birthday).format('YYYYMMDD')
        }
    },
    filters: {
        moment: function(date) {
            return moment(date).format('YYYY/MM/DD HH:mm:SS')
        }
    },
}

</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>