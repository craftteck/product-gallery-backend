<?php

namespace Packages\Usecase\Product\Read;

interface ReadProductInteractorInterface {
    public function execute(ReadProductCommand $command): ReadProductDto;
}
