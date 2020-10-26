<?php

function setActive($params) {
    return request()->routeIs($params) ? 'active' : '';
}
