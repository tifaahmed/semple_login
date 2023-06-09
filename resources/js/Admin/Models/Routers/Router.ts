// import Vue from 'vue'

import Axios from 'axios' ;
import jwt   from './../../../Services/jwt' ;
// import RolePermisionServices   from './../../../Services/RolePermision' ;

export default class Router   {
    name : string = '' ;
    headers  : object = 
         { 
                'Authorization':  jwt.Authorization,
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
                'localization' : 'en'
         };   
      responseType : any = 'json' ;
      routerPrefix : string = '/api/dashboard/' ;    

      page : any = null ;
      PerPage : any = null ;
      filter : any = {} ;

   // async IfAuth() : Promise<any>  { 
   //    if ( jwt.Authorization != null+ ' ' +null && !jwt.if_accessToken_expire && jwt.User) {
   //       return true
   //    }else{
   //       return false
   //    }
   // } 
   async createParamsArray() { 
      var params_array : any = {};
      params_array['page'] = this.page;
      params_array['per_page'] =this.PerPage

      for (var key in this.filter) {
         if (this.filter[key]) {
            params_array['filter['+key+']'] = this.filter[key];
         }
      }
      return params_array; 

   } 

   async AllAxios(filter:object = {}) : Promise<any>  { 
      this.filter = filter;
         return  await  Axios.get( 
            this.routerPrefix+this.name ,
            { 
               headers : this.headers , responseType : this.responseType,
               params  : await this.createParamsArray()
            }
         ) ;
   }

   async PaginateAxios(page : number , PerPage :number, filter:object = {} ) : Promise<any>  { 
      this.page = page;
      this.PerPage = PerPage;
      this.filter = filter;

      return await Axios.get( 
         this.routerPrefix+this.name+'/collection', 
            { 
               headers : this.headers ,responseType : this.responseType ,       
               params: await this.createParamsArray()
            } ,
      ); 
   }
   async PaginateTrashAxios(page : number , PerPage :number, filter:object = {}) : Promise<any>  { 
      this.page = page;
      this.PerPage = PerPage;
      this.filter = filter;
      
      return await Axios.get( 
         this.routerPrefix+this.name+'/collection-trash', 
         { 
            headers : this.headers ,responseType : this.responseType ,       
            params  : await this.createParamsArray()
         } ,
     ); 
   }
   
   async StoreAxios(formData : any) : Promise<any>  {
       return  await Axios.post( 
         this.routerPrefix+this.name , 
          formData , 
          { headers : this.headers , responseType : this.responseType}
       );

    }

    async DeleteAxios(id : number) : Promise<any>  { 
         return  await  Axios.post( 
            this.routerPrefix+this.name+'/'+id ,
            { headers : this.headers , responseType : this.responseType}
         ) ;
    }
    
    async PremanentlyDeleteAxios(id : number) : Promise<any>  { 
      return  await  Axios.post( 
         this.routerPrefix+this.name+'/premanently-delete/'+id ,
         { headers : this.headers , responseType : this.responseType}
      ) ;
   }
 
   async ShowAxios(id : number) : Promise<any>  {
      return await Axios.get( 
         this.routerPrefix+this.name+'/'+id+'/show', 
         { headers : this.headers , responseType : this.responseType}
      ); 
   } 
   async TrashShowAxios(id : number) : Promise<any>  {
      return await Axios.get( 
         this.routerPrefix+this.name+'/'+id+'/show-trash', 
         { headers : this.headers , responseType : this.responseType}
      ); 
} 
   
   async UpdateAxios(id : number ,formData ?: any) : Promise<any>  { 
      return await Axios.post( 
         this.routerPrefix+this.name+'/'+id+'/update', 
         formData ,
         { headers : this.headers , responseType : this.responseType}
      ); 
   }
   async RstoreRowAxios(id : number) : Promise<any>  {
      return await Axios.get( 
         this.routerPrefix+this.name+'/'+id+'/restore', 
         { headers : this.headers , responseType : this.responseType}
      ); 
   }

   

}

      