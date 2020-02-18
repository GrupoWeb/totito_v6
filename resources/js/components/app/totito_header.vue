<template>
    <div class="container my-5 mx-5">
        <div class="row">
            <div class="col">
                <table >
                    <tr  v-for="(indexs, rs) in 3" :key="rs">
                    <td v-for="(index, r) in 3" :key="r" class="cuadro " v-bind:id="'fila_'+indexs+'_'+index" :ref="indexs + '_' + index" @click="evento(indexs + '_' + index,indexs)">
                            <span  class="data_x_hidden">X</span>
                            <span  class="data_y_hidden">O</span>
                    </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <div>
                    <label class="label">Jugador 1</label><br>
                        <span>-> {{ jugada_x }}</span> <br>
                    <label class="label">Jugador 2</label><br>
                        <span>-> {{ jugada_y }}</span> 
                </div>
            </div>
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
</style>
<script>
export default {
    data() {
        return {
            data_x:true,
            data_o:false,
            seleccion: 0,
            jugada_x:"",
            jugada_y:"",
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
                

            ]
        }
    },
    methods: {
        evento(val,filas) {
            const ctx = this.$refs[val];
            ctx[0].classList.add('data_x')
            const cantidad = ctx[0].children.length
            this.check_jugada(val,this.seleccion,filas)
            // console.log(this.seleccion)
            for(let x = 0; x < cantidad; x++){
                ctx[0].children[this.seleccion].classList.remove('data_x_hidden')
                ctx[0].children[this.seleccion].classList.add('data_x')
            }

            if(this.seleccion == 0 ){
                
                this.seleccion++
                this.jugada_x = this.jugada_x + '_'+val
            }else{
                
                this.seleccion = 0
                this.jugada_y = this.jugada_y + '_' + val
            }

            
            
        },
        check_jugada(val,seleccion,filas){
            const sp = this.$refs[val];
            console.log(filas)
            for(let row = 1; row <= 3; row++){
                for(let col=1; col <= 3; col++){
                    console.log(sp[0].id)
                }
            }


            // for(let fila = 0; fila < this.handle_jugada.length; fila++){
            //     // console.log(this.handle_jugada[fila][0])
            //     for(let dato = 0;dato <= 5; dato++){
            //         if(this.handle_jugada[fila][dato] == this.jugada_x){
            //             // console.log(this.handle_jugada[fila][dato])
            //             alert("gano")
            //         }
            //     }
            // }
        }
    }
}
</script>