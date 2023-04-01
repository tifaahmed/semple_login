<template>
    <div>
         
        <b-button v-b-modal="modal_id" variant="outline-primary" > {{ValueColumn?.length}}</b-button>
        <b-modal :id="modal_id"   >
            <div  v-for="( RowVal , Rowkey )  in ValueColumn??ValueColumn" :key="Rowkey"   >
                <div  v-for="( valLoop , Loopkey )  in LoopOnColumn" :key="Loopkey"   >
                    <div v-if="valLoop && RowVal  && RowVal[valLoop?.name] !== 'null'" style="    text-align: center;"> 
                        <ColumsIndex  
                            :ValueColumn="RowVal && RowVal[valLoop?.name] ? RowVal[valLoop?.name]: null"   
                            :typeColumn="valLoop?.type" 
                            :LoopOnColumn="valLoop?.secondLoopOnColumn"
                        />
                    </div>
                </div> 
            </div>
        </b-modal>
    </div>
</template>

<script> 
import ColumsIndex          from './ColumsIndex.vue'     ;

export default {
    name:"MultiSelectForloopColumn_SelectForloopColumn",
    components:{
       ColumsIndex
    },

    data( ) { return {
        modal_id : 'model_'+this.randomNumber()
     } } ,

    props   : {
        ValueColumn :null,
        LoopOnColumn :[],
    } ,
    methods : {
        randomNumber : function(){
        return Math.floor(Math.random() * (10000 - 1 + 1)) + 1;
        },
    }
} </script>