<?php
declare(strict_types=1);

namespace teewurst\Prs4AdvancedWildcardComposer\Pipeline\Factory;

use teewurst\Prs4AdvancedWildcardComposer\Di\Container;
use teewurst\Prs4AdvancedWildcardComposer\Di\FactoryInterface;
use teewurst\Prs4AdvancedWildcardComposer\Pipeline\Pipeline;
use teewurst\Prs4AdvancedWildcardComposer\Pipeline\Task\FilterAndValidateWildcardsTask;
use teewurst\Prs4AdvancedWildcardComposer\Pipeline\Task\GenerateComposerDeveplomentJsonTask;
use teewurst\Prs4AdvancedWildcardComposer\Pipeline\Task\IterateAndTranslateTask;
use teewurst\Prs4AdvancedWildcardComposer\Pipeline\Task\LoadPsr7AutoloadDefinitionsTask;
use teewurst\Prs4AdvancedWildcardComposer\Pipeline\Task\ReplacePsr4AutoloadTask;

/**
 * Class PipelineFactory
 *
 * @package teewurst\Prs4AdvancedWildcardComposer\Pipeline\Factory
 * @author  Martin Ruf <Martin.Ruf@check24.de>
 */
class PipelineFactory implements FactoryInterface
{

    /**
     * Creates an Instance of Pipeline and adds tasks
     *
     * @param Container $container
     * @param string    $name
     *
     * @return Pipeline
     */
    public function __invoke(Container $container, string $name)
    {
        $pipeline = new Pipeline();

        $pipeline->pipe($container->get(LoadPsr7AutoloadDefinitionsTask::class));
        $pipeline->pipe($container->get(FilterAndValidateWildcardsTask::class));
        $pipeline->pipe($container->get(IterateAndTranslateTask::class));
        $pipeline->pipe($container->get(ReplacePsr4AutoloadTask::class));
        $pipeline->pipe($container->get(GenerateComposerDeveplomentJsonTask::class));

        return $pipeline;
    }
}
