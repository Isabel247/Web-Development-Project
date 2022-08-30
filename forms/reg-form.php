<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <div class="form-container">
        <div class="reg-form">
            <div class="heading">
                <h2>Registration Form</h2>
            </div>
            <div class="wrap">
                <div class="f1">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" id="first_name">
                    <span class="focus-input"></span>
                </div>
                <div class="f2">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" id="last_name">
                    <span class="focus-input"></span>
                </div>
            </div>
            <div class="wrap2">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <span class="focus-input2"></span>
            </div>
            <div class="wrap2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <span class="focus-input2"></span>
            </div>
            
            <div class="wrap2">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number">
                    <span class="focus-input2"></span>
            </div>
            <div class="wrap2">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address">
                    <span class="focus-input2"></span>
            </div>

            <button class="reg-btn">Register</button>

        </div>

        <div class="reg-image">
                <img src="./images/c-art.png" alt="" class="img">
            </div>
    </div>
</body>

<style>
    /*====================REGISTRATION FORM=====================*/
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    background: #ced3e7;
    font-family: sans-serif;
}
input{
    outline: none;
    border: none;
}
.heading {
  width: 80%;
}
.heading h2 {
  font-size: 2rem;
  font-weight: 400;
  color: #412277;
}
.form-container{
    width:80%;
    position: absolute;
    left:50%;
    top:50%;
    transform: translate(-50%, -50%);
    height: 95vh;
    background-color: #f8f9fb;
    display: flex;
    box-shadow: 5px 10px 38px rgba(0,0,0,0.2);
}
.reg-form{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 55%;
}
.reg-image{
    width:45%;
}
.img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.wrap2{
    width: 80%;
    position: relative;
    border-bottom: 2px solid #b2b2b2;
    margin-bottom: 13px;
}
.wrap{
    display:flex;
    width: 80%;
    justify-content: center;
}
.f1{
    border-bottom: 2px solid #b2b2b2;
    width: 40%;
    position: relative;
}
.f2{
    border-bottom: 2px solid #b2b2b2;
    margin-left: auto;
    width:50%;
    position: relative;
}
label{
    font-size: 12px;
    color: #676768;
    line-height: 1.5;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    width: 80%;
    min-height: 25px;
    border-bottom: none;
    padding: 15px 0;
    margin-top: 10px;
    margin-bottom: 0;
    padding-bottom: 2px;
}
input{
    display: block;
    width: 100%;
    font-size: 14px;
    background: transparent;
    color: #0f0f0f;
    padding: 5px 0px;
}
.reg-btn{
    margin-top: 20px;
    width: 200px;
    height: 50px;
    border-radius: 40px;
    outline: none;
    font-weight: 600;
    font-size: 1 rem;
    border: none;
    background: #445a94;
    color: #fff;
    box-shadow: 8px 10px 30px rgba(0,0,0,0.329);
    transition: 0.4s;
}
.reg-btn:hover{
    background: #4b2888;
    color: #fff;
    cursor: pointer;
}

.focus-input{
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}
.focus-input2::before{
    content: "";
    display: block;
    position: absolute;
    bottom: -1px;
    left: 0;
    width:0;
    height: 2px;
    transition: all 0.6s;
    background: #412277;
}
input:focus * .focus-input2::before{
    width: 100%;
}
.has-val.input * .focus-input2::before{
    width: 100%;
}
@media(max-width: 1250px){
    .form-container{
        width: 90%;
    }
}
@media(max-width: 1000px){
    .reg-image{
        display:none;
    }
    
}
@media(max-width: 768px){
    .form-container{
        width: 100%;
        height: 100vh;
    }
    .reg-form{
        width: 100%;
    }
}
</style>
</html>