<template>
    <div>
        <h3>詳細画面</h3>

        <v-form ref="form" v-model="valid">
            <v-container style="max-width:100%;">
                <v-row>
                    <v-col cols="3">
                        <v-text-field v-model="forms.textbox" label="テキストボックス"
                            :rules="[rules.required, rules.max_16]"></v-text-field>
                    </v-col>

                    <v-col cols="9">
                        <v-container>
                            <v-row>
                                <div :class="errors.checkbox ? `theme--light v-label error--text` : `theme--light v-label`"
                                    style="margin-bottom: 0.4rem;font-size: 12px;">ラジオボタン</div>
                            </v-row>
                            <v-row>
                                <v-radio-group v-model="forms.radiobtn" label="" row :rules="[rules.required]">
                                    <v-radio v-for="(name, index) in constant.RADIOS" :key=index :label=name
                                        :value=index></v-radio>
                                </v-radio-group>
                            </v-row>
                        </v-container>
                    </v-col>

                    <v-col cols="3">
                        <v-select v-model="forms.select" label="セレクトボックス" :items="constant.SELECTS" item-text=name
                            item-value=id :rules="[rules.required]"></v-select>
                    </v-col>



                    <v-col cols="9" class="text-left">
                        <v-container>
                            <v-row>
                                <div :class="errors.checkbox ? `theme--light v-label error--text` : `theme--light v-label`"
                                    style="margin-bottom: 0.0rem;font-size:12px !important;">チェックボックス</div>
                            </v-row>
                            <v-row style="margin-top: 20px;">
                                <v-checkbox v-model="forms.checkbox" v-for="(name, index) in constant.CHECKS" :key=index
                                    :label=name :value=index style="margin: 0 16px 0 0;" :rules="[rules.check_least_1]"
                                    hide-details @change="changeCheckbox"></v-checkbox>
                            </v-row>
                            <div class="v-messages error--text row" style="margin-top:18px;">{{ messages.checkbox }}
                            </div>
                        </v-container>
                    </v-col>
                    <v-col cols="3">
                        <v-textarea counter label="Text" :rules="rules" :value="value" rows="2"></v-textarea>
                    </v-col>
                    <v-col cols="9">
                    </v-col>

                    <v-col cols="2">
                        <v-text-field v-model="inputDate" type="date" label="入社日－開始" hide-details />
                    </v-col>

                    <v-col cols="3">
                        <v-img width=100 src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"></v-img>
                    </v-col>



                </v-row>
            </v-container>
            <v-btn :disabled="!valid" color="primary" @click="submit">
                削除
            </v-btn>
        </v-form>

    </div>
</template>
    
<script>
export default {

    props: {
        id: String,
        mode: String
    },

    data() {
        return {
            valid: true,			// ①
            constant: {				// ②
                RADIOS: {},
                SELECTS: [],
                CHECKS: {},
            },
            forms: {				// ③
                textbox: '',
                textarea: '',
                radiobtn: '2',
                select: '',
                checkbox: [],
            },
            rules: {				// ④
                required: value => !!value || '必須です。',
                max_16: value => value.length <= 16 || '16文字以内です。',
                max_100: value => value.length <= 100 || '100文字以内です。',
                check_least_1: value => {
                    return value.length > 0 || '1つは必須選択です。'
                }
            },
            errors: {
                checlbox: false,
            },
            messages: {
                checkbox: "",
            }
        }
    },
    created() {

        // ⑤
        //   axios.get('/const').then((res) => {
        //let constData = res.data.const;
        let constData = {
            "RADIOS": {
                "1": "Radio1",
                "2": "Radio2",
                "3": "Radio3"
            },
            "SELECTS": {
                "1": "Select1",
                "2": "Select2",
                "3": "Select3",
                "4": "Select4"
            },
            "CHECKS": {
                "1": "Check1",
                "2": "Check2",
                "3": "Check3",
                "4": "Check4",
                "5": "Check5",
                "6": "Check6",
                "7": "Check7",
                "8": "Check8"
            }
        };
        this.constant.RADIOS = constData.RADIOS;
        this.constant.SELECTS = Object.entries(constData.SELECTS).map(([key, name]) => ({ 'id': key, 'name': name }))
        this.constant.CHECKS = constData.CHECKS;

    },
    methods: {
        submit() {
            console.log("submit!")
            // 送信処理
        },
        changeCheckbox() {		// ⑥
            this.errors.checkbox = false;
            this.messages.checkbox = '';
            if (this.forms.checkbox.length == 0) {
                this.errors.checkbox = true;
                this.messages.checkbox = '1つは必須選択です。';
            }
        },
        radioClear() {			// ⑦
            this.forms.radiobtn = '';
        }
    },
}
</script>
<style>
.v-input--selection-controls {
    margin-top: 0px !important;
}
</style>