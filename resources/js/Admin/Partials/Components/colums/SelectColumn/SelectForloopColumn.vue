<template>
    <div>
        <div  v-for="( valLoop , Loopkey )  in LoopOnColumn ?? LoopOnColumn" :key="Loopkey"   >
            <div v-if="valLoop && ValueColumn  && ValueColumn[valLoop] !== 'null'"> 
                <ColumsIndex  
                    :ValueColumn="ValueColumn && ValueColumn[valLoop.name] ? ValueColumn[valLoop.name] : null"   
                    :typeColumn="valLoop?.type" 
                    :LoopOnColumn="valLoop?.secondLoopOnColumn"
                />
            </div>
        </div> 
    </div>
</template>

<script> 
import ColumsIndex          from './ColumsIndex.vue'     ;

export default {
    name:"SelectColumn_SelectForloopColumn",
    components:{
       ColumsIndex
    },

    data( ) { return {
     } } ,

    props   : {
        ValueColumn :null,
        LoopOnColumn :[],
    } ,

} </script>