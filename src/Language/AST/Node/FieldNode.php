<?php

namespace Digia\GraphQL\Language\AST\Node;

use Digia\GraphQL\Language\AST\Node\Behavior\AliasTrait;
use Digia\GraphQL\Language\AST\Node\Behavior\ArgumentsTrait;
use Digia\GraphQL\Language\AST\Node\Behavior\DirectivesTrait;
use Digia\GraphQL\Language\AST\Node\Behavior\NameTrait;
use Digia\GraphQL\Language\AST\Node\Behavior\SelectionSetTrait;
use Digia\GraphQL\Language\AST\Node\Contract\SelectionNodeInterface;
use Digia\GraphQL\Language\AST\NodeKindEnum;

class FieldNode extends AbstractNode implements SelectionNodeInterface
{

    use AliasTrait;
    use NameTrait;
    use ArgumentsTrait;
    use DirectivesTrait;
    use SelectionSetTrait;

    /**
     * @var string
     */
    protected $kind = NodeKindEnum::FIELD;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'kind'         => $this->kind,
            'loc'          => $this->getLocationAsArray(),
            'alias'        => $this->getAliasAsArray(),
            'name'         => $this->getNameAsArray(),
            'arguments'    => $this->getArgumentsAsArray(),
            'directives'   => $this->getDirectivesAsArray(),
            'selectionSet' => $this->getSelectionSetAsArray(),
        ];
    }
}