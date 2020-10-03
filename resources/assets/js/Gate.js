export default class Gate{

    constructor(user){
        this.user = user;
    }


    isAdmin(){
        return this.user.user_type === 'admin';
    }

    isCustomer(){
        return this.user.user_type === 'customer';
    }
    isAdminOrTailor(){
        if(this.user.user_type === 'admin' || this.user.user_type === 'tailor'){
            return true;
        }

    }
    isAdminOrStore(){
        if(this.user.user_type === 'admin' || this.user.user_type === 'store'){
            return true;
        }

    }
    isAuthorOrCustomer(){
        if (this.user.user_type === 'user' || this.user.user_type === 'customer'){
            return true;
        }

    }



}

