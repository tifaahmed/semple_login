<template>
	<div>
			<p class="mg-b-20"   v-for="( columnRow , columnRowkey    ) in Columns??Columns " :key="columnRowkey" >  
			    <span style="color:blue">{{columnRow.header}} :</span>	
				<ColumsIndex  
					:ValueColumn="SingleTableRows && SingleTableRows[columnRow?.name] ?SingleTableRows[columnRow?.name] :null"   
					:typeColumn="columnRow?.type" 
					:LoopOnColumn="columnRow?.loopOnColumn"
				/>
			</p>
	</div>

</template>
<script>
import ColumsIndex          from 'AdminPartials/Components/colums/ColumsIndex.vue'     ;

export default {
	name:'ModalRows',

    components : {
        ColumsIndex
    } ,
	props : {
	    Columns : Array ,
		SingleTableRows: Object
	},

}
</script>