<template>
	<div>
		 <InputString
		 	v-if= "
				FactoryType === 'string' || 
				FactoryType === 'datetime-local' || 
				FactoryType === 'time' || 
				FactoryType === 'email' || 
				FactoryType === 'password'
			"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		/>
		<InputNumber
		 	v-if= "
				FactoryType === 'integer' || 
				FactoryType === 'number' 
			"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		/>
		<InputTextarea
		 	v-if= "FactoryType === 'textarea'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		/>
		<InputCkEditor
		 	v-if= "FactoryType === 'ck_editor'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		/>
		<InputFile
	 		v-else-if    = "
			FactoryType === 'image' || 
			FactoryType === 'file'
			"
			:PropLable = "Factorylable"
			:PropPlaceholder = "FactoryPlaceholder"
			:PropType = "FactoryType"
			:PropName = "FactoryName"
			:PropErrors = "FactoryErrors"
			@change      = "change"
			v-model      = "data"
		/>
		<InputDate
		 	v-if= "FactoryType === 'date'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		 /> 

		<InputMultiSelect
			v-if= "FactoryType === 'multiSelect'"
			:PropLable = "Factorylable"
			:PropType = "FactoryType"
			:PropName = "FactoryName"
			:PropErrors = "FactoryErrors"
			@change      = "change"
			v-model      = "data"

			:PropSelectOptions = "FactorySelectOptions"

			:PropSelectStrings = "FactorySelectStrings"
			:PropSelectForloopStrings = "FactorySelectForloopStrings"
			:PropSelectForloopStringKeys = "FactorySelectForloopStringKeys"

			:PropSelectimages = "FactorySelectImages"
			:PropSelectForloopImages= "FactorySelectForloopImages"
			:PropSelectForloopImageKeys = "FactorySelectForloopImageKeys"
		/> 
		<InputSelect
			v-if= "FactoryType === 'select'"
			:PropLable = "Factorylable"
			:PropType = "FactoryType"
			:PropName = "FactoryName"
			:PropErrors = "FactoryErrors"
			@change      = "change"
			v-model      = "data"
			
			:PropSelectOptions = "FactorySelectOptions"

			:PropSelectStrings = "FactorySelectStrings"
			:PropSelectForloopStrings = "FactorySelectForloopStrings"
			:PropSelectForloopStringKeys = "FactorySelectForloopStringKeys"

			:PropSelectimages = "FactorySelectImages"
			:PropSelectForloopImages= "FactorySelectForloopImages"
			:PropSelectForloopImageKeys = "FactorySelectForloopImageKeys"

		/> 
		

		<InputRadioCheckBox
		 	v-if= "FactoryType === 'Radio'"
		     :PropLable = "Factorylable"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
			 :PropSelectOptions = "FactorySelectOptions"
		/> 
		<InputBoolean
		 	v-if= "FactoryType === 'Boolean'"
		     :PropLable = "Factorylable"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
			 :PropSelectOptions = "FactorySelectOptions"
		/> 
		<!-- <InputForloop
		 	v-if= "FactoryType === 'Forloop'"
		     :PropLable = "Factorylable"
		     :PropForloop = "FactoryForloop"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		 /> -->

		 
	</div>
    
</template>


<script>
import InputString     from 'AdminPartials/Components/Inputs/InputString.vue'     ;
import InputNumber     from 'AdminPartials/Components/Inputs/InputNumber.vue'     ;

import InputTextarea     	from 'AdminPartials/Components/Inputs/InputTextarea.vue'     ;
import InputCkEditor     	from 'AdminPartials/Components/Inputs/InputCkEditor.vue'     ;
import InputFile     	from 'AdminPartials/Components/Inputs/InputFile.vue'     ;
// import InputForloop     	from 'AdminPartials/Components/Inputs/InputForloop.vue'     ;
import InputDate     	from 'AdminPartials/Components/Inputs/InputDate.vue'     ;

import InputMultiSelect     	from 'AdminPartials/Components/Inputs/InputMultiSelect.vue'     ;
import InputSelect     	from 'AdminPartials/Components/Inputs/InputSelect.vue'     ;

import InputRadioCheckBox     	from 'AdminPartials/Components/Inputs/InputRadioCheckBox.vue'     ;
import InputBoolean     	from 'AdminPartials/Components/Inputs/InputBoolean.vue'     ;

export default {

	data( ) { return {
		data : this.value,

	} } ,
	components : {
	    InputString ,
	    InputNumber ,
		InputFile,InputDate,
		InputMultiSelect,
		InputRadioCheckBox,
		InputSelect,
		InputTextarea,
		InputCkEditor,
		InputBoolean
		// InputForloop
		// InputMultiSelect
	} ,
	props   : {
		Factorylable : 			{  default                       : ''        } ,
		// FactoryForloop : 		{ default                    : ''        } ,
		
		FactoryPlaceholder : 	{  default                       : ''        } ,
		FactoryType : 			{  default                       : ''        } ,
		FactoryName :  			{  default                       : ''        } ,
		FactoryErrors : 		{  required : false	   } ,
		value       : 			null,


		FactorySelectOptions			:[] ,

		FactorySelectStrings			:  [] ,
		FactorySelectForloopStrings		:  [] ,
		FactorySelectForloopStringKeys	:  [] ,

		FactorySelectImages				:  [] ,
		FactorySelectForloopImages		:  [] ,
		FactorySelectForloopImageKeys   :  [] ,

		
	} ,
	watch   : {
		value( ) {
		    this.data = this.value ;
		}
	} ,
	methods : {
	    change( data ) {
	    	this.data = data
	        this.$emit( 'input'  ,  this.data   ) ;
	    }
	} 
}
</script>

