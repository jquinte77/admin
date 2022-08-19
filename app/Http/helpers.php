<?php

    function setActiveRoute($name){
        return request()->routeIs($name) ? 'active':'';
    }

    function ArrValidate($arr){
        return ( ( $arr ?? '' ) == ''? NULL: $arr);
    }

    function validateRoute($route){
        return ( ( $route ?? '' ) == ''? 'javascript:void(0)' : $route );
    }
