<?php

namespace MichaelaKarkosova\Calculator;

interface NumberFactory {
    public function create($number): NumberInterface;
}