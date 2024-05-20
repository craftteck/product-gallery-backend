<?php

namespace Tests\Unit\Product;

use Mockery;
use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Read\ReadProductCommand;
use Packages\Usecase\Product\Read\ReadProductDto;
use Packages\Usecase\Product\Read\ReadProductInteractor;
use PHPUnit\Framework\TestCase;

class ReadProductInteractorTest extends TestCase
{
    /**
     * プロダクトの取得処理実行
     */
    public function test_execute(): void
    {
        $command = new ReadProductCommand(id: 1);

        $repository = Mockery::mock(ProductRepositoryInterface::class);
        $repository->shouldReceive('findById')
            ->once()
            ->with($command->id)
            ->andReturn(
                new Product(
                    id: 1,
                    userId: 1,
                    name: 'name',
                    summary: 'summary',
                    description: 'description',
                    url: 'url',
                )
            );

        $interactor = new ReadProductInteractor($repository);
        $result = $interactor->execute($command);

        $expected = new ReadProductDto(
            id: 1,
            userId: 1,
            name: 'name',
            summary: 'summary',
            description: 'description',
            url: 'url',
        );
        $this->assertEquals($expected, $result);
    }
}
