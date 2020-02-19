<template>
    <div class="container my-5 mx-5">
        <div class="row">
            <div class="col">
                <table >
                    <tr  v-for="(indexs, rs) in 3" :key="rs">
                    <td v-for="(index, r) in 3" :key="r" class="cuadro active" v-bind:id="'fila_'+(indexs-1)+'_'+index" :ref="(indexs-1)+ '_' + index" @click="evento((indexs-1) + '_' + index, index,(indexs-1),$event)">
                            <span  class="data_x_hidden">X</span>
                            <span  class="data_y_hidden">O</span>
                    </td>
                    </tr>
                </table>
            </div>
            <!-- <div class="col">
                <div>
                    <label class="label">Jugador 1</label><br>
                        <span>-> {{ jugada_ganadora }}</span> <br>
                    <label class="label">Jugador 2</label><br>
                        <span>-> {{ jugada_y }}</span>
                </div>
            </div> -->
        </div>

    </div>
</template>

<style lang="css">
    .cuadro{
        width: 200px;
        height: 200px;
        border: 1px solid #000;
        text-align: center;

    }

    .data_x{
        font-size: 2em;
    }

    .data_x_hidden{
        display: none;
    }
    .data_y_hidden{
        display: none;
    }
    .data_y{
        font-size: 2em;
    }
    .winner_x{
        background-color: #005ce6 !important;
        color:#fff !important;
    }

    .winner_y{
        background-color: #cc0000 !important;
        color: #fff;
    }
    .not-active {
        /* cursor: not-allowed; */
         pointer-events: none;
    }
</style>
<script>
export default {
    data() {
        return {
            ganador_x_uno:0,
            ganador_x_dos:0,
            ganador_x_tres:0,
            data_x:true,
            data_o:false,
            seleccion: 0,
            jugada_x:"",
            jugada_y:"",
            jugada_ganadora:[],
            get_watch_play:[],
            handle_jugada:[
                {
                    0:    '_1_1_1_2_1_3',
                    1:    '_1_3_1_2_1_1',
                    2:    '_1_2_1_1_1_3',
                    3:    '_1_2_1_3_1_1',
                    4:    '_1_3_1_1_1_2',
                    5:    '_1_1_1_3_1_2',

                },
                {
                    0:    '_2_1_2_2_2_3',
                    1:    '_2_3_2_2_2_1',
                    2:    '_2_2_2_1_2_3',
                    3:    '_2_2_2_3_2_1',
                    4:    '_2_3_2_1_2_2',
                    5:    '_2_1_2_3_2_2',
                },
                {
                    0:    '_3_1_3_2_3_3',
                    1:    '_3_3_3_2_3_1',
                    2:    '_3_2_3_1_3_3',
                    3:    '_3_2_3_3_3_1',
                    4:    '_3_3_3_1_3_2',
                    5:    '_3_1_3_3_3_2',
                },
                {
                    0:    '_1_1_2_2_3_3',
                    1:    '_3_3_2_2_1_1',
                    2:    '_3_3_1_1_2_2',
                    3:    '_2_2_1_1_3_3',
                    4:    '_2_2_3_3_1_1',
                    5:    '_1_1_3_3_2_2',
                },
                {
                    0:    '_1_3_2_2_3_1',
                    1:    '_3_1_2_2_1_3',
                    2:    '_3_1_1_3_2_2',
                    3:    '_2_2_1_3_3_1',
                    4:    '_2_2_3_1_1_3',
                    5:    '_1_3_3_1_2_2',
                },
                {
                    0:    '_1_1_2_1_3_1',
                    1:    '_3_1_2_1_1_1',
                    2:    '_3_1_1_1_2_1',
                    3:    '_2_1_1_1_3_1',
                    4:    '_2_1_3_1_1_1',
                    5:    '_1_1_3_1_2_1',
                },
                {
                    0:    '_1_2_2_2_3_2',
                    1:    '_3_2_2_2_1_2',
                    2:    '_3_2_1_2_2_2',
                    3:    '_2_2_1_2_3_2',
                    4:    '_2_2_3_2_1_2',
                    5:    '_1_2_3_2_2_2',
                },
                {
                    0:    '_1_3_2_3_3_3',
                    1:    '_3_3_2_3_1_3',
                    2:    '_3_3_1_3_2_3',
                    3:    '_2_3_1_3_3_3',
                    4:    '_2_3_3_3_1_3',
                    4:    '_1_3_3_3_2_3',
                },


            ],
            posible_y:""
            
            
        }
    },
    // mounted() {
    //     this.get_play('0_2');
        
    // },
    methods: {
        evento(val,filas,posicion,event) {
            console.log(event)
            const ctx = this.$refs[val];
            // ctx[0].classList.add('data_x')
            const cantidad = ctx[0].children.length
            
            // console.log(ctx[0].classList)

            // if(this.$refs[val][0].classList[1] != 'not-active'){
                if(this.seleccion == 0 ){
                    // for(let x = 0; x < cantidad; x++){
                        
                        ctx[0].children[this.seleccion].classList.remove('data_x_hidden')
                        ctx[0].children[this.seleccion].classList.add('data_x')
                        ctx[0].classList.remove('active')
                        ctx[0].classList.add('not-active')
                    // }
                    this.check_jugada(val,this.seleccion,filas,posicion)
                    this.seleccion++

                    let url = 'watch_play'
                    axios.post(url,{jugada:val}).
                        then(response => {
                            for(let x = 0; x < response.data.length; x++){
                                this.get_watch_play.push({
                                    data:response.data[0]
                                })
                            }
                                if(this.get_watch_play.length != 0){
                                    console.log('posible')
                                    this.possible_play(filas,posicion)
                            }else{
                                this.jugador_automatico(val,filas,posicion)
                            }
                        })
                   
                }else{
                    
                    // for(let x = 0; x < cantidad; x++){
                        ctx[0].children[this.seleccion].classList.remove('data_y_hidden')
                        ctx[0].children[this.seleccion].classList.add('data_y')
                        ctx[0].classList.remove('active')
                        ctx[0].classList.add('not-active')
                    // }
                    this.check_jugada(val,1,filas,posicion)
                    this.seleccion = 0
                    // this.jugada_y = this.jugada_y + '_' + val
                }
            // }
            // else if(this.$refs[val][0].classList[1] != 'active'){
            //     console.log('falso')
            // }   
            



        },
        number_random(min, max){
            return Math.round(Math.random() * (max - min) + min);
        },
        color_winner(ganador,primero,segundo,tercero){
            if(ganador === 'x'){
                this.$refs[primero][0].classList.add('winner_x');
                this.$refs[segundo][0].classList.add('winner_x');
                this.$refs[tercero][0].classList.add('winner_x');
                
            }else{
                this.$refs[primero][0].classList.add('winner_y');
                this.$refs[segundo][0].classList.add('winner_y');
                this.$refs[tercero][0].classList.add('winner_y');
            }
        },
        jugador_automatico(val,filas,posicion){

            
            let fila = this.number_random(0,2); 
            let pos = this.number_random(1,3); 
            let jugada = fila+'_'+pos
            const ver = this.$refs[jugada];
            const v_clase_x = this.$refs[jugada][0].children[0]
            const v_clase_y = this.$refs[jugada][0].children[1]
            
            if((val != jugada) && (v_clase_x.className === 'data_x_hidden') && (v_clase_y.className != 'data_y')){
                this.evento(jugada,filas,posicion)
               // console.log(val,'-',jugada,'-',v_clase_x.className,'-',v_clase_y.className)
               
            }else{
                
                this.jugador_automatico(val,filas,posicion)
            }
        },
        check_f_uno(seleccion,data_clase){
            

                    let handle_rows_1 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_2 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_3 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    if((handle_rows_1 === data_clase) && (handle_rows_2 === data_clase) && (handle_rows_3 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '0_2',
                            tercera: '0_3'
                        })
                        return 3
                    }

                    let handle_rows_4 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_5 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_6 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_4 === data_clase) && (handle_rows_5 === data_clase) && (handle_rows_6 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '0_2',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    let handle_rows_7 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_8 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_9 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_7 === data_clase) && (handle_rows_8 === data_clase) && (handle_rows_9 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '0_1',
                            tercera: '0_3'
                        })
                        return 3
                    }

                    let handle_rows_10 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_11 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_12 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_10 === data_clase) && (handle_rows_11 === data_clase) && (handle_rows_12 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '0_3',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    let handle_rows_13 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_14 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_15 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_13 === data_clase) && (handle_rows_14 === data_clase) && (handle_rows_15 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '0_1',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    let handle_rows_16 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_17 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_18 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_16 === data_clase) && (handle_rows_17 === data_clase) && (handle_rows_18 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '0_3',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    /* columna 1 */

                    let handle_rows_19 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_20 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_21 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_19 === data_clase) && (handle_rows_20 === data_clase) && (handle_rows_21 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '1_1',
                            tercera: '2_1'
                        })
                        return 3
                    }

                    let handle_rows_22 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_23 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_24 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_22 === data_clase) && (handle_rows_23 === data_clase) && (handle_rows_24 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '2_1',
                            tercera: '1_1'
                        })
                        return 3
                    }

                    let handle_rows_25 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_26 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_27 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_25 === data_clase) && (handle_rows_26 === data_clase) && (handle_rows_27 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '2_1',
                            tercera: '0_1'
                        })
                       return 3
                    }

                    let handle_rows_28 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_29 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_30 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_28 === data_clase) && (handle_rows_29 === data_clase) && (handle_rows_30 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '0_1',
                            tercera: '2_1'
                        })
                        return 3
                    }

                    let handle_rows_31 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_32 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_33 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_31 === data_clase) && (handle_rows_32 === data_clase) && (handle_rows_33 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '0_1',
                            tercera: '1_1'
                        })
                        return 3
                    }

                    let handle_rows_34 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_35 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_36 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_34 === data_clase) && (handle_rows_35 === data_clase) && (handle_rows_36 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '1_1',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    //-----------------------------------------------------

                    let handle_rows_37 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_38 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_39 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_37 === data_clase) && (handle_rows_38 === data_clase) && (handle_rows_39 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '1_2',
                            tercera: '2_3'
                        })
                       return 3
                    }

                    let handle_rows_40 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_41 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_42 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_40 === data_clase) && (handle_rows_41 === data_clase) && (handle_rows_42 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '2_3',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    let handle_rows_43 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_44 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_45 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_43 === data_clase) && (handle_rows_44 === data_clase) && (handle_rows_45 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '0_1',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_46 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_47 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_48 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_46 === data_clase) && (handle_rows_47 === data_clase) && (handle_rows_48 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '2_3',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    let handle_rows_49 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_50 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_51 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    if((handle_rows_49 === data_clase) && (handle_rows_50 === data_clase) && (handle_rows_51 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '0_1',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    let handle_rows_52 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_53 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_54 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_52 === data_clase) && (handle_rows_53 === data_clase) && (handle_rows_54 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '1_2',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    /* column 2 */
                    let handle_rows_55 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_56 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_57 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_55 === data_clase) && (handle_rows_56 === data_clase) && (handle_rows_57 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '1_2',
                            tercera: '2_2'
                        })
                        return 3
                    }

                    let handle_rows_58 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_59 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_60 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_58 ===data_clase) && (handle_rows_59 === data_clase) && (handle_rows_60 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '2_2',
                            tercera: '1_2'
                        })
                        return 3
                    }
                    
                    let handle_rows_61 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_62 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_63 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_61 === data_clase) && (handle_rows_62 === data_clase) && (handle_rows_63 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '2_2',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    let handle_rows_64 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_65 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_66 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_64 === data_clase) && (handle_rows_65 === data_clase) && (handle_rows_66 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '0_2',
                            tercera: '2_2'
                        })
                        return 3
                    }

                    let handle_rows_67 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_68 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_69 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_67 === data_clase) && (handle_rows_68 === data_clase) && (handle_rows_69 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '0_2',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    let handle_rows_70 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_71 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_72 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_70 === data_clase) && (handle_rows_71 === data_clase) && (handle_rows_72 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '1_2',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    /* columna 3 */

                    let handle_rows_73 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_74 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_75 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_73 === data_clase) && (handle_rows_74 === data_clase) && (handle_rows_75 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '1_3',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_76 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_77 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_78 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_76 === data_clase) && (handle_rows_77 === data_clase) && (handle_rows_78 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '2_3',
                            tercera: '1_3'
                        })
                        return 3
                    }
                    
                    let handle_rows_79 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_80 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_81 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_79 === data_clase) && (handle_rows_80 === data_clase) && (handle_rows_81 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '2_3',
                            tercera: '0_3'
                        })
                        return 3
                    }

                    let handle_rows_82 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_83 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_84 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_82 === data_clase) && (handle_rows_83 === data_clase) && (handle_rows_84 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '0_3',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_85 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_86 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_87 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_85 === data_clase) && (handle_rows_86 === data_clase) && (handle_rows_87 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '0_3',
                            tercera: '1_3'
                        })
                        return 3
                    }

                    let handle_rows_88 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_89 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_90 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_88 === data_clase) && (handle_rows_89 === data_clase) && (handle_rows_90 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '1_3',
                            tercera: '0_3'
                        })
                        return 3
                    }
        },
        check_f_dos(seleccion,data_clase){    
                                   
                    let handle_rows_1 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_2 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_3 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_1 === data_clase) && (handle_rows_2 === data_clase) && (handle_rows_3 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '1_2',
                            tercera: '1_3'
                        })
                        return 3
                    }

                    let handle_rows_4 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_5 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_6 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_4 === data_clase) && (handle_rows_5 === data_clase) && (handle_rows_6 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '1_2',
                            tercera: '1_1'
                        })
                        return 3
                    }

                    let handle_rows_7 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_8 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_9 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_7 === data_clase) && (handle_rows_8 === data_clase) && (handle_rows_9 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '1_1',
                            tercera: '1_3'
                        })
                        return 3
                    }

                    let handle_rows_10 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_11 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_12 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_10 === data_clase) && (handle_rows_11 === data_clase) && (handle_rows_12 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '1_3',
                            tercera: '1_1'
                        })
                        return 3
                    }

                    let handle_rows_13 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_14 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_15 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_13 === data_clase) && (handle_rows_14 === data_clase) && (handle_rows_15 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '1_1',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    let handle_rows_16 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_17 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_18 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_16 === data_clase) && (handle_rows_17 === data_clase) && (handle_rows_18 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '1_3',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    /* columna 1 */
                    let handle_rows_19 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_20 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_21 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_19 === data_clase) && (handle_rows_20 === data_clase) && (handle_rows_21 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '1_1',
                            tercera: '2_1'
                        })
                        return 3
                    }

                    let handle_rows_22 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_23 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_24 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_22 === data_clase) && (handle_rows_23 === data_clase) && (handle_rows_24 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '2_1',
                            tercera: '1_1'
                        })
                       return 3
                    }

                    let handle_rows_25 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_26 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_27 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_25 === data_clase) && (handle_rows_26 === data_clase) && (handle_rows_27 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '2_1',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    let handle_rows_28 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_29 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_30 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_28 === data_clase) && (handle_rows_29 === data_clase) && (handle_rows_30 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '0_1',
                            tercera: '2_1'
                        })
                        return 3
                    }

                    let handle_rows_31 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_32 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_33 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_31 === data_clase) && (handle_rows_32 === data_clase) && (handle_rows_33 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '0_1',
                            tercera: '1_1'
                        })
                        return 3
                    }

                    let handle_rows_34 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_35 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_36 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0]; 
                    
                    if((handle_rows_34 === data_clase) && (handle_rows_35 === data_clase) && (handle_rows_36 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '1_1',
                            tercera: '0_1'
                        })
                        return 3
                    }

                    /* column 2 */
                    let handle_rows_55 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_56 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_57 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_55 === data_clase) && (handle_rows_56 === data_clase) && (handle_rows_57 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '1_2',
                            tercera: '2_2'
                        })
                        return 3
                    }

                    let handle_rows_58 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_59 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_60 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_58 === data_clase) && (handle_rows_59 === data_clase) && (handle_rows_60 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '2_2',
                            tercera: '1_2'
                        })
                        return 3
                    }
                    
                    let handle_rows_61 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_62 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_63 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_61 === data_clase) && (handle_rows_62 === data_clase) && (handle_rows_63 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '2_2',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    let handle_rows_64 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_65 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_66 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_64 === data_clase) && (handle_rows_65 === data_clase) && (handle_rows_66 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '0_2',
                            tercera: '2_2'
                        })
                        return 3
                    }

                    let handle_rows_67 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_68 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_69 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_67 === data_clase) && (handle_rows_68 === data_clase) && (handle_rows_69 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '0_2',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    let handle_rows_70 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_71 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_72 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_70 === data_clase) && (handle_rows_71 === data_clase) && (handle_rows_72 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '1_2',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    /* columna 3 */

                    let handle_rows_73 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_74 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_75 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_73 === data_clase) && (handle_rows_74 === data_clase) && (handle_rows_75 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '1_3',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_76 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_77 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_78 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_76 === data_clase) && (handle_rows_77 === data_clase) && (handle_rows_78 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '2_3',
                            tercera: '1_3'
                        })
                        return 3
                    }
                    
                    let handle_rows_79 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_80 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_81 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_79 === data_clase) && (handle_rows_80 === data_clase) && (handle_rows_81 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '2_3',
                            tercera: '0_3'
                        })
                        return 3
                    }

                    let handle_rows_82 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_83 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_84 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_82 === data_clase) && (handle_rows_83 === data_clase) && (handle_rows_84 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '0_3',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_85 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_86 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_87 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_85 === data_clase) && (handle_rows_86 === data_clase) && (handle_rows_87 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '0_3',
                            tercera: '1_3'
                        })
                        return 3
                    }

                    let handle_rows_88 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_89 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_90 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_88 === data_clase) && (handle_rows_89 === data_clase) && (handle_rows_90 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '1_3',
                            tercera: '0_3'
                        })
                        return 3
                    }

        },
        check_f_tres(seleccion,data_clase){
            

                    let handle_rows_1 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_2 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_3 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_1 === data_clase) && (handle_rows_2 === data_clase) && (handle_rows_3 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '2_2',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_4 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_5 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_6 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_4 === data_clase) && (handle_rows_5 === data_clase) && (handle_rows_6 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '2_2',
                            tercera: '2_1'
                        })
                        return 3
                    }


                    let handle_rows_7 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_8 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_9 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_7 === data_clase) && (handle_rows_8 === data_clase) && (handle_rows_9 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '2_1',
                            tercera: '2_3'
                        })
                        return 3
                    }


                    let handle_rows_10 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_11 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_12 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_10 === data_clase) && (handle_rows_11 === data_clase) && (handle_rows_12 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '2_3',
                            tercera: '2_1'
                        })
                        return 3
                    }


                    let handle_rows_13 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_14 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_15 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_13 === data_clase) && (handle_rows_14 === data_clase) && (handle_rows_15 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '2_1',
                            tercera: '2_2'
                        })
                        return 3
                    }


                    let handle_rows_16 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_17 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_18 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_16 === data_clase) && (handle_rows_17 === data_clase) && (handle_rows_18 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '2_3',
                            tercera: '2_2'
                        })
                        return 3
                    }


                    let handle_rows_19 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_20 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_21 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_19 === data_clase) && (handle_rows_20 === data_clase) && (handle_rows_21 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '1_1',
                            tercera: '2_1'
                        })
                        return 3
                    }


                    let handle_rows_22 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_23 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_24 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_22 === data_clase) && (handle_rows_23 === data_clase) && (handle_rows_24 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_1',
                            segunda: '2_1',
                            tercera: '1_1'
                        })
                        return 3
                    }


                    let handle_rows_25 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_26 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_27 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_25 === data_clase) && (handle_rows_26 === data_clase) && (handle_rows_27 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '2_1',
                            tercera: '0_1'
                        })
                        return 3
                    }


                    let handle_rows_28 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_29 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_30 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_28 === data_clase) && (handle_rows_29 === data_clase) && (handle_rows_30 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_1',
                            segunda: '0_1',
                            tercera: '2_1'
                        })
                        return 3
                    }


                    let handle_rows_31 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_32 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_33 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_31 === data_clase) && (handle_rows_32 === data_clase) && (handle_rows_33 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '0_1',
                            tercera: '1_1'
                        })
                        return 3
                    }


                    let handle_rows_34 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_35 = this.$refs[1 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_36 = this.$refs[0 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_34 === data_clase) && (handle_rows_35 === data_clase) && (handle_rows_36 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '1_1',
                            tercera: '0_1'
                        })
                        return 3
                    }


                    let handle_rows_37 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_38 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_39 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_37 === data_clase) && (handle_rows_38 === data_clase) && (handle_rows_39 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '1_2',
                            tercera: '0_3'
                        })
                        return 3
                    }


                    let handle_rows_40 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_41 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_42 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_40 === data_clase) && (handle_rows_41 === data_clase) && (handle_rows_42 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '0_3',
                            tercera: '1_2'
                        })
                        return 3
                    }


                    let handle_rows_43 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_44 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_45 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];

                    if((handle_rows_43 === data_clase) && (handle_rows_44 === data_clase) && (handle_rows_45 === data_clase) ){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '0_3',
                            tercera: '2_1'
                        })
                        return 3
                    }


                    let handle_rows_46 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_47 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_48 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_46 === data_clase) && (handle_rows_47 === data_clase) && (handle_rows_48 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '2_1',
                            tercera: '0_3'
                        })
                        return 3
                    }


                    let handle_rows_49 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_50 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_51 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_49 === data_clase) && (handle_rows_50 === data_clase) && (handle_rows_51 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '0_3',
                            tercera: '1_2'
                        })
                        return 3
                    }


                    let handle_rows_52 = this.$refs[2 + '_' + 1][0].children[seleccion].classList[0];
                    let handle_rows_53 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_54 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_52 === data_clase) && (handle_rows_53 === data_clase) && (handle_rows_54 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_1',
                            segunda: '1_2',
                            tercera: '0_3'
                        })
                        return 3
                    }

                    /* column 2 */
                    let handle_rows_55 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_56 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_57 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_55 === data_clase) && (handle_rows_56 === data_clase) && (handle_rows_57 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '1_2',
                            tercera: '2_2'
                        })
                        return 3
                    }

                    let handle_rows_58 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_59 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_60 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_58 === data_clase) && (handle_rows_59 === data_clase) && (handle_rows_60 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_2',
                            segunda: '2_2',
                            tercera: '1_2'
                        })
                        return 3
                    }
                    
                    let handle_rows_61 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_62 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_63 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_61 === data_clase) && (handle_rows_62 === data_clase) && (handle_rows_63 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '2_2',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    let handle_rows_64 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_65 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_66 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_64 === data_clase) && (handle_rows_65 === data_clase) && (handle_rows_66 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_2',
                            segunda: '0_2',
                            tercera: '2_2'
                        })
                        return 3
                    }

                    let handle_rows_67 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_68 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_69 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_67 === data_clase) && (handle_rows_68 === data_clase) && (handle_rows_69 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '0_2',
                            tercera: '1_2'
                        })
                        return 3
                    }

                    let handle_rows_70 = this.$refs[2 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_71 = this.$refs[1 + '_' + 2][0].children[seleccion].classList[0];
                    let handle_rows_72 = this.$refs[0 + '_' + 2][0].children[seleccion].classList[0];

                    if((handle_rows_70 === data_clase) && (handle_rows_71 === data_clase) && (handle_rows_72 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_2',
                            segunda: '1_2',
                            tercera: '0_2'
                        })
                        return 3
                    }

                    /* columna 3 */

                    let handle_rows_73 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_74 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_75 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_73 === data_clase) && (handle_rows_74 === data_clase) && (handle_rows_75 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '1_3',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_76 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_77 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_78 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_76 === data_clase) && (handle_rows_77 === data_clase) && (handle_rows_78 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '0_3',
                            segunda: '2_3',
                            tercera: '1_3'
                        })
                        return 3
                    }
                    
                    let handle_rows_79 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_80 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_81 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_79 === data_clase) && (handle_rows_80 === data_clase) && (handle_rows_81 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '2_3',
                            tercera: '0_3'
                        })
                        return 3
                    }

                    let handle_rows_82 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_83 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_84 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_82 === data_clase) && (handle_rows_83 === data_clase) && (handle_rows_84 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '1_3',
                            segunda: '0_3',
                            tercera: '2_3'
                        })
                        return 3
                    }

                    let handle_rows_85 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_86 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_87 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_85 === data_clase) && (handle_rows_86 === data_clase) && (handle_rows_87 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '0_3',
                            tercera: '1_3'
                        })
                        return 3
                    }

                    let handle_rows_88 = this.$refs[2 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_89 = this.$refs[1 + '_' + 3][0].children[seleccion].classList[0];
                    let handle_rows_90 = this.$refs[0 + '_' + 3][0].children[seleccion].classList[0];

                    if((handle_rows_88 === data_clase) && (handle_rows_89 === data_clase) && (handle_rows_90 === data_clase)){
                        this.jugada_ganadora.push({
                            seleccion: seleccion,
                            primera: '2_3',
                            segunda: '1_3',
                            tercera: '0_3'
                        })
                        return 3
                    }


        },
        save_play(){
                let url = 'save_play'
                axios.post(url,{
                    jugada:this.jugada_ganadora
                }).then(response => {
                    return response.data
                });
        },
        message_winner(){
            const swalWithBootstrapButtons = this.$swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Partida Nueva?',
            text: "quiere continuar jugando",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No, Terminar!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === this.$swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
        },
        disable_canvas(){

        },
        possible_play(filas,posicion){
            this.posible_y = ""
            
            let cantidad = this.get_watch_play.length
            let poss = this.number_random(0,(cantidad-1))
            this.posible_y = this.get_watch_play[poss].data.segunda
            const v_clase = this.$refs[this.posible_y][0].children[0].classList[0]
            if(v_clase != 'data_x'){
                this.evento(this.posible_y,filas,posicion)
            }else{
                this.jugador_automatico(this.posible_y,filas,posicion)
            }
            this.get_watch_play = []
        },
        check_jugada(val,seleccion,filas,posicion) {
                
                
                if(seleccion === 0){
                    this.ganador_x_uno = this.check_f_uno(seleccion,'data_x')
                    this.ganador_x_dos = this.check_f_dos(seleccion, 'data_x')
                    this.ganador_x_tres = this.check_f_tres(seleccion, 'data_x')
                    
                    if(this.ganador_x_uno === 3){
                        this.color_winner('x',this.jugada_ganadora[0].primera,this.jugada_ganadora[0].segunda,this.jugada_ganadora[0].tercera)
                        this.save_play()
                        this.message_winner()
                    }else if(this.ganador_x_dos === 3){
                        this.color_winner('x',this.jugada_ganadora[0].primera,this.jugada_ganadora[0].segunda,this.jugada_ganadora[0].tercera)
                        this.save_play()
                        this.message_winner()
                    }else if(this.ganador_x_tres === 3){
                        this.color_winner('x',this.jugada_ganadora[0].primera,this.jugada_ganadora[0].segunda,this.jugada_ganadora[0].tercera)
                        this.save_play()
                        this.message_winner()
                    }
                }else{
                    this.ganador_x_uno = this.check_f_uno(seleccion,'data_y')
                    this.ganador_x_dos = this.check_f_dos(seleccion, 'data_y')
                    this.ganador_x_tres = this.check_f_tres(seleccion, 'data_y')
                    
                    if(this.ganador_x_uno === 3){
                        this.color_winner('y',this.jugada_ganadora[0].primera,this.jugada_ganadora[0].segunda,this.jugada_ganadora[0].tercera)
                        this.$swal('Ganaste y!!!');
                    }else if(this.ganador_x_dos === 3){
                        this.color_winner('y',this.jugada_ganadora[0].primera,this.jugada_ganadora[0].segunda,this.jugada_ganadora[0].tercera)
                        this.$swal('Ganastey!!!');
                    }else if(this.ganador_x_tres === 3){
                        this.color_winner('y',this.jugada_ganadora[0].primera,this.jugada_ganadora[0].segunda,this.jugada_ganadora[0].tercera)
                        this.$swal('Ganaste y!!!');
                    }
                }

            }


 /*
            * array de jugadas por x,o
            * la variable fila me da la posicion actual de la fila
            * la variaable seleccion me da el jugador ----- 0= jugador X, 01 = jugador Y
            * */
            //console.log(this.handle_ganador.length)

            //console.log(filas)
            //const sp = this.$refs[val];

            //for(let handle_array = 0; handle_array < this.handle_ganador.length; handle_array++){
            //console.log(this.handle_ganador[filas])
            //}

            //console.log(referencia[0].children[seleccion].classList[0]);
            //for(let col=1; col <= 3; col++){
            //  console.log(sp[0].id)
            //}

            //console.log(this.$refs[handle_rows][0].children[seleccion].attributes.class.nodeValue)
            // for(let fila = 0; fila < this.handle_jugada.length; fila++){
            //     // console.log(this.handle_jugada[fila][0])
            //     for(let dato = 0;dato <= 5; dato++){
            //         if(this.handle_jugada[fila][dato] == this.jugada_x){
            //             // console.log(this.handle_jugada[fila][dato])
            //             alert("gano")
            //         }
            //     }
            // }
        //}

        
            //for(let row = 1; row <= 3; row++){
              //  let handle_rows_horizontal = posicion + '_' + row;
                //const referencia = this.$refs[handle_rows_horizontal][0].children[seleccion].classList[0];
                //if(referencia === 'data_x'){
                  //  x++
                //}
            //}

            //for(let row = 0; row < 3; row++){
              //  let handle_rows_horizontal = row + '_' + filas;
                //const referencia = this.$refs[handle_rows_horizontal][0].children[seleccion].classList[0];
                //if(referencia === 'data_x'){
                  //  x++
               // }
            //}
            //console.log(x)
            // console.log(val,'_',filas,'_',posicion)

    }
}
</script>
