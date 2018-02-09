<?php

namespace Digia\GraphQL\Type\Definition\Scalar;

use Digia\GraphQL\Language\AST\Node\NodeInterface;
use Digia\GraphQL\Language\AST\KindEnum;
use Digia\GraphQL\Type\Definition\TypeEnum;

class BooleanType extends ScalarType
{

    /**
     * @inheritdoc
     */
    protected function beforeConfig(): void
    {
        $this->setName(TypeEnum::BOOLEAN);
        $this->setDescription('The `Boolean` scalar type represents `true` or `false`.');
        $this->setSerialize(function ($value) {
            return $this->coerceValue($value);
        });
        $this->setParseValue(function ($value) {
            return $this->coerceValue($value);
        });
        $this->setParseLiteral(function (NodeInterface $astNode) {
            return $astNode->getKind() === KindEnum::BOOLEAN ? $astNode->getValue() : null;
        });
    }

    /**
     * @param $value
     * @return bool
     * @throws \TypeError
     */
    private function coerceValue($value): bool
    {
        if ($value === '') {
            throw new \TypeError('Boolean cannot represent non boolean value: (empty string)');
        }

        if (!is_scalar($value)) {
            throw new \TypeError('Boolean cannot represent a non-scalar value');
        }

        return (bool)$value;
    }
}
