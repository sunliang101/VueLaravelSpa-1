<template>

    <v-container style="max-width:100%;">
        <v-row>
            <v-col  xs="12" md="4">
                <v-card class="mx-auto pa-2" max-width="400">
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="text-h5 text-center">
                                2022年12月09日（金）
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-card-text>
                        <v-row align="center">
                            <v-col cols="12">
                                <v-select :items="items" label="所属" dense outlined
                                    hide-details></v-select></v-col>
                            <v-col cols="6">
                                <v-btn color="primary" x-large width="100%">
                                    出勤
                                </v-btn>
                            </v-col>
                            <v-col cols="6">
                                <v-btn color="primary" x-large width="100%">
                                    退勤
                                </v-btn>
                            </v-col>
                        </v-row>
                        </v-card-text>

                        <v-card-title class="overline py-1">所属１</v-card-title>
                    <v-card-text>

                        <v-row>
                            <v-col cols="6">
                                <v-text-field hide-details label="予定" placeholder="Placeholder" v-model="message2" 　
                                    outlined></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field hide-details label="実績" placeholder="Placeholder" v-model="message2" 　
                                    outlined></v-text-field>
                            </v-col>
                        </v-row>



                    </v-card-text>
                    <v-divider class="mx-2"></v-divider>
                    <v-card-title class="overline py-1">所属２</v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field hide-details label="予定" placeholder="Placeholder" v-model="message2" 　
                                    outlined></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field hide-details label="実績" placeholder="Placeholder" v-model="message2" 　
                                    outlined></v-text-field>
                            </v-col>
                        </v-row>



                    </v-card-text>

                </v-card>
            </v-col>
            <v-col  xs="12" md="4">
                <v-card max-width="400">

                    <v-card-text style="padding-bottom:0px !important;">
                        <div class="text-h6">
                            月集計　2022年12月
                        </div>
                    </v-card-text>
                    <v-card-title class="overline py-1">所属１</v-card-title>
                    <v-card-text>

                        <v-row>
                            <v-col cols="6">
                                <v-text-field hide-details label="予定" placeholder="Placeholder" v-model="message1" 　
                                    outlined></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field hide-details label="実績" placeholder="Placeholder" v-model="message1" 　
                                    outlined></v-text-field>
                            </v-col>
                        </v-row>



                    </v-card-text>
                    <v-divider class="mx-2"></v-divider>
                    <v-card-title class="overline py-1">所属２</v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field hide-details label="予定" placeholder="Placeholder" v-model="message1" 　
                                    outlined></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field hide-details label="実績" placeholder="Placeholder" v-model="message1" 　
                                    outlined></v-text-field>
                            </v-col>
                        </v-row>



                    </v-card-text>
                    <v-card-actions class="mb-3">
                        <v-btn color="deep-purple lighten-2" text >
                            出勤詳細
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            labels: ['SU', 'MO', 'TU', 'WED', 'TH', 'FR', 'SA'],
            items: ['所属１', '所属２'],
            time: 0,
            forecast: [
                { day: 'Tuesday', icon: 'mdi-white-balance-sunny', temp: '24\xB0/12\xB0' },
                { day: 'Wednesday', icon: 'mdi-white-balance-sunny', temp: '22\xB0/14\xB0' },
                { day: 'Thursday', icon: 'mdi-cloud', temp: '25\xB0/15\xB0' },
            ],
            formdata: {
                value: "",

            },
            message1: "19",
            message2: "09:00 - 17:30"
        }
    },
}
</script>