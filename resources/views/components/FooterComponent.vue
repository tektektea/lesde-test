<template>
    <div class="w-full bg-gray-100 p-6 flex justify-around">
        <ul>
           <li :id="item.route_name" v-for="item in linkLeft">
               <a class="menu-item">{{item.label}}</a>
           </li>
        </ul>
        <div>
            logo
        </div>
        <ul>
            <li :id="item.route_name" v-for="item in linkRight">
                <a  class="menu-item">{{item.label}}</a>
            </li>
        </ul>
    </div>
</template>
<script setup>
const linkLeft = [
    {route_name:'about',label:'About us'},
    {route_name:'contact',label:'Contact us'},
];
const linkRight = [
    {route_name:'about',label:'Privacy policy'},
    {route_name:'contact',label:'Terms and conditions'},
];
</script>
