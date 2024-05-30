<?php

namespace Packages\Usecase\Product\Update;

interface UpdateProductInteractorInterface {
    public function execute(UpdateProductCommand $command): UpdateProductDto;
}
